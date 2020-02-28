<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = "home";

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    protected function sendLoginResponse(Request $request)
    {
        //check active status
        if ($this->guard()->user()->status == 0){
            Auth::logout();
            return redirect('login')->with('error', 'Your account is not active. Please contact with admin.');
        }

        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        return $this->authenticated($request, $this->guard()->user())
            ?: redirect()->intended($this->redirectPath());
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleProviderCallback($provider)
    {
        $userSocial = Socialite::driver($provider)->user();

        $user = $this->checkExitUser($provider, $userSocial->getEmail(), $userSocial->id);

        if(!$user){

            $user = User::create([
                'role_id'     => 2,
                'account_type_id' => 0,
                'name'        => $userSocial->name?:$userSocial->nickname,
                'email'       => $userSocial->email,
                'provider'    => $provider,
                'provider_id' => $userSocial->id,
                'expire_date' => Carbon::today()->addMonths(12)->format('Y-m-d'),
                'is_paid' => 0
            ]);
        }

        Auth::login($user);

        return redirect('home');
    }

    public function checkExitUser($provider, $email, $provider_id){

        if ($email){
            $user = User::where(['email' => $email])->where('provider', $provider)->first();
            if ($user) return $user;
        }

        $user = User::where('provider_id', $provider_id)->where('provider', $provider)->first();
        if ($user) return $user;

        return false;
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return $this->loggedOut($request) ?: redirect('/');
    }
}
