<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Payment;
use DB;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->perPage ?: 10;
        $keyword = $request->keyword;

        $payments = Payment::with('user');

        if($keyword){

            $keyword = '%'.$keyword.'%';

            $payments = $payments->where('amount', 'like', $keyword)
                ->orWhere('status', 'like', $keyword)
                ->orWhere('created_at', 'like', $keyword)
                ->orWhere('transaction_id', 'like', $keyword)
                ->orWhereHas('user', function ($query) use ($keyword) {
                    $query->where(DB::raw("CONCAT(`name`, ' ', `last_name`)"), 'like', $keyword)
                        ->orWhere('email', 'like', $keyword)
                        ->orWhere('phone', 'like', $keyword);
                });
        }

        $payments = $payments->latest()->paginate($perPage);

        return view('admin.payment.index', compact('payments'));
    }
}
