<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Validation\ValidationException;
use App\LdapCustom\LdapConnectTrait;

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
    protected $redirectTo = '/home';

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
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return Response
     */
    public function authenticate(Request $request)
    {

    }

    protected function attemptLogin(Request $request)
    {
        //if (Auth::attempt(['email' => $email, 'password' => $password, 'active' => 1])) {
        $input = $request->input();
        $username = explode('@', $input['email'])[0];

        // Get the user details from database and check if user is exist and active.
        $user = User::where('username',$username)->first();

        if($user){
            if (!$user->is_actif) {
                throw ValidationException::withMessages([$this->username() => __('User has been desactivated.')]);
            }
        } else {
            throw ValidationException::withMessages([$this->username() => __('Infos de connexion non valides !')]);
        }

        $credentials = ['username' => $username, 'password' => $input['password']];
        if ($user->is_ldap) {
            if (Auth::guard('ldap')->attempt($credentials)) {
                return redirect('/');
            }
        }

        // Or using the default guard you've configured, likely "users"
        if ($user->is_local) {
            $credentials = $request->only('email', 'password');
            if (Auth::attempt($credentials)) {
                return redirect('/');
            }
        }

        /*if (Auth::attempt(['email' => $input['email'], 'password' => $input['password'] ])) {
            // Authentication passed...
            return redirect()->intended('/');
        }*/
    }
}
