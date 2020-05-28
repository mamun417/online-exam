<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Model\Department;
use App\Model\Package;
use App\Notifications\RegistrationSuccessNotification;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\View\View;
use Mail;

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = 'home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the application registration form.
     *
     * @return Application|Factory|View
     */
    public function showRegistrationForm()
    {
        $departments = Department::latest()->get();
        $packages = Package::latest()->get();
        return view('auth.register', compact('departments', 'packages'));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'department_id'   => ['required'],
            'name'            => ['required', 'string', 'max:255'],
            'last_name'       => ['required', 'string', 'max:255'],
            'email'           => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone'           => ['required', 'string', 'max:255', 'unique:users'],
            'password'        => ['required', 'string', 'min:8', 'confirmed'],
            'account_type_id' => ['required'],
            'payment_type_id' => ['required_if:account_type_id,==,1'],
            'package_id'      => ['required_if:account_type_id,==,1'],
            'agree'           => ['required']
        ],[
            'payment_type_id.required_if' => 'The payment type field is required.',
            'package_id.required_if'      => 'The package type field is required.'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        //paid user registration
        if ($data['account_type_id'] == 1 && $data['payment_type_id'] == 1){
            $this->redirectTo = 'payment';
        }

        return User::create([
            'department_id'     => $data['department_id'],
            'role_id'           => 2,
            'account_type_id'   => $data['account_type_id'],
            'package_id'        => $data['package_id'],
            'name'              => $data['name'],
            'last_name'         => $data['last_name'],
            'email'             => $data['email'],
            'phone'             => $data['phone'],
            'password'          => Hash::make($data['password']),
            'expire_date'       => Carbon::today()->addMonths(12)->format('Y-m-d'),
            'is_paid'           => 0
        ]);
    }

    /**
     * The user has been registered.
     *
     * @param Request $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        $user->notify(new RegistrationSuccessNotification($user));
    }
}
