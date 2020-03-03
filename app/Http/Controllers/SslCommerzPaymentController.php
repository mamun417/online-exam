<?php

namespace App\Http\Controllers;

use Auth;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use App\Library\SslCommerz\SslCommerzNotification;
use Route;
use Session;

class SslCommerzPaymentController extends Controller
{
    public function exampleHostedCheckout()
    {
        return view('exampleHosted');
    }

    public function test(){
        info(Session::get('payment_tran_id'));

        # Custom
        //store tran_id to session
        Session::put('payment_tran_id', uniqid());
        //Session::forget('payment_tran_id');

        info(Session::get('payment_tran_id'));
    }

    public function index(Request $request)
    {
        $post_data['tran_id'] = Session::get('payment_tran_id') ?? uniqid(); // tran_id must be unique

        $this->test();

        //return redirect(url('http://facebook.com'));

        # Here you have to receive all the order data to initate the payment.
        # Let's say, your oder transaction informations are saving in a table called "payments"
        # In "payments" table, order unique identity is "transaction_id". "status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.

        $post_data = array();
        $post_data['total_amount'] = '1000'; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = Session::get('payment_tran_id') ?? uniqid(); // tran_id must be unique

        $user = Auth::user();

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = $user->name.' '.$user->last_name ?? 'Customer Name';
        $post_data['cus_email'] = $user->email ?? 'customer@mail.com';
        $post_data['cus_phone'] = $user->phone ?? '8801XXXXXXXXX';
        $post_data['cus_add1'] = $request->customer_address ?? 'Customer Address';
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "Dhaka";
        $post_data['cus_state'] = $request->customer_state ?? "Dhaka";
        $post_data['cus_postcode'] = $request->customer_zip ?? "1205";
        $post_data['cus_country'] = $request->customer_country ?? "Bangladesh";
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Payment";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1205";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Medi Spark";
        $post_data['product_category'] = "Payment";
        $post_data['product_profile'] = "payment";

        # Before  going to initiate the payment order status need to insert or update as Pending.
        DB::table('payments')
            ->updateOrInsert(
                ['transaction_id' => $post_data['tran_id']],
                [
                    'user_id' => $user->id,
                    'amount' => $post_data['total_amount'],
                    'status' => 'Pending',
                    'transaction_id' => $post_data['tran_id'],
                    'currency' => $post_data['currency'],
                    'created_at' => Carbon::now()
                ]
            );

        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'hosted');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }
    }

    public function success(Request $request)
    {

        $tran_id = $request->input('tran_id');
        $amount = $request->input('amount');
        $currency = $request->input('currency');

        $sslc = new SslCommerzNotification();

        #Check order status in order table against the transaction id or order id.
        $order_detials = DB::table('payments')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_detials->status == 'Pending') {
            $validation = $sslc->orderValidate($tran_id, $amount, $currency, $request->all());

            if ($validation == TRUE) {

                /*
                That means IPN did not work or IPN URL was not set in your merchant panel. Here you need to update order status
                in order table as Processing or Complete.
                Here you can also sent sms or email for successfull transaction to customer
                */

                DB::table('payments')
                    ->where('transaction_id', $tran_id)
                    ->update(['status' => 'Complete']);

                # Custom
                if (Session::get('renew')){
                    $user_info = DB::table('users')->where('id', Auth::id())->first();
                    DB::table('users')->where('id', Auth::id())->update([
                        'account_type_id' => 1,
                        'is_paid' => 1,
                        'expire_date' => Carbon::createFromFormat('Y-m-d', $user_info->expire_date)->addMonths(12)->format('Y-m-d')
                    ]);
                }else{
                    DB::table('users')->where('id', Auth::id())->update(['account_type_id' => 1, 'is_paid' => 1]);
                }

                Session::forget(['payment_tran_id', 'renew']);
                Session::put('payment_success', 'Your payment has been successful');

                //echo "<br >Transaction is successfully Completed";

            } else {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel and Transation validation failed.
                Here you need to update order status as Failed in order table.
                */
                $update_product = DB::table('payments')
                    ->where('transaction_id', $tran_id)
                    ->update(['status' => 'Failed']);

                Session::put('payment_fail', 'Your payment has been failed.');

                //echo "validation Fail";
            }
        } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            /*
             That means through IPN Order status already updated. Now you can just show the customer that transaction is completed. No need to udate database.
             */
            Session::put('payment_success', 'Your payment already has been successful.');

            //echo "Transaction is successfully Completed";
        } else {

            Session::put('payment_fail', 'Your payment has been failed.');

            #That means something wrong happened. You can redirect customer to your product page.
            //echo "Invalid Transaction";
        }

        return redirect('home');
    }

    public function fail(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_detials = DB::table('payments')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_detials->status == 'Pending') {
            $update_product = DB::table('payments')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Failed']);

            //echo "Transaction is Falied";
            Session::put('payment_fail', 'Your payment has been failed.');

        } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            Session::put('payment_success', 'Your payment already has been successful.');
            //echo "Transaction is already Successful";
        } else {
            //echo "Transaction is Invalid";
            Session::put('payment_fail', 'Your payment has been failed.');
        }

        return redirect('home');
    }

    public function cancel(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_detials = DB::table('payments')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_detials->status == 'Pending') {
            $update_product = DB::table('payments')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Canceled']);

            Session::put('payment_fail', 'Your payment has been failed.');
           // echo "Transaction is Cancel";

        } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            Session::put('payment_success', 'Your payment already has been successful.');
            // echo "Transaction is already Successful";
        } else {
            Session::put('payment_fail', 'Your payment has been failed.');
            //echo "Transaction is Invalid";
        }

        return redirect('home');
    }

    public function ipn(Request $request)
    {
        #Received all the payement information from the gateway
        if ($request->input('tran_id')) #Check transation id is posted or not.
        {

            $tran_id = $request->input('tran_id');

            #Check order status in order tabel against the transaction id or order id.
            $order_details = DB::table('payments')
                ->where('transaction_id', $tran_id)
                ->select('transaction_id', 'status', 'currency', 'amount')->first();

            if ($order_details->status == 'Pending') {
                $sslc = new SslCommerzNotification();
                $validation = $sslc->orderValidate($tran_id, $order_details->amount, $order_details->currency, $request->all());
                if ($validation == TRUE) {
                    /*
                    That means IPN worked. Here you need to update order status
                    in order table as Processing or Complete.
                    Here you can also sent sms or email for successful transaction to customer
                    */
                    $update_product = DB::table('payments')
                        ->where('transaction_id', $tran_id)
                        ->update(['status' => 'Complete']);

                    echo "Transaction is successfully Completed";
                } else {
                    /*
                    That means IPN worked, but Transation validation failed.
                    Here you need to update order status as Failed in order table.
                    */
                    $update_product = DB::table('payments')
                        ->where('transaction_id', $tran_id)
                        ->update(['status' => 'Failed']);

                    echo "validation Fail";
                }

            } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {

                #That means Order status already updated. No need to udate database.

                echo "Transaction is already successfully Completed";
            } else {
                #That means something wrong happened. You can redirect customer to your product page.

                echo "Invalid Transaction";
            }
        } else {
            echo "Invalid Data";
        }
    }

}
