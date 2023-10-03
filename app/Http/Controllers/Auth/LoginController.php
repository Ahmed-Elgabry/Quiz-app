<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    protected $redirectTo = '/u/dashboard';
    protected $maxAttempts = 5; // Default is 5
    protected $decayMinutes = 2; // Default is 1

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function login(Request $request)
    {
        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }
        $this->validate($request, [
                'email'    => 'required',
                'password' => 'required',
            ]);

        //Store Email field Value
        $loginValue = $request->input('email');

        //Get Login Type
        $login_type = $this->getLoginType( $loginValue);

        //Change request type based on user input
        $request->merge([
            $login_type => $loginValue
        ]);

        //Check Credentials and redirect
        if (Auth::attempt($request->only($login_type, 'password'),true/* , $request->get('remember') */)) {
            // to reset login attempts.
            $this->clearLoginAttempts($request);
            return redirect()->intended($this->redirectPath());
        }
        //this will increment the failed attempt count.
        $this->incrementLoginAttempts($request);
         return redirect()->back()->withInput()->withErrors([ 'email' => __("These credentials do not match our records.") ]);
    }

    //Check user input type
    public function getLoginType($loginValue) {
        return filter_var($loginValue, FILTER_VALIDATE_EMAIL ) ? 'email' : 'username';
    }

    public function logout(Request $request) {
        Auth::logout();
        return redirect()->route('home' , ['lang'=>'ar'] );
      }

}
