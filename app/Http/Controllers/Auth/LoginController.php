<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Validation\ValidationException;
use App\LdapCustom\LdapConnectTrait;
use Hash;

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
    protected $redirectTo = '/';

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        //
        return redirect()->route('home') ;
    }

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
     * The path to redirect authenticated users to.
     *
     * @return string
     */
    public function redirectTo()
    {
        return url('/');
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

        $credentials = [
            'username' => $username,
            'email' => $username . '' . config('app.ldap_domain'),
            'password' => $input['password']
        ];
        if ($user->is_ldap) {
            if (Auth::guard('ldap')->attempt($credentials)) {
                Auth::login($user);
                // Update du PWD LDAP local
                $ldapaccount = $user->ldapaccount;
                $ldapaccount->upadte( ['password' => Hash::make($credentials['password'])] );
                return redirect()->intended('/');
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
