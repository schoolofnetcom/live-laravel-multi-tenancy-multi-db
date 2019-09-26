<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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

    public function showLoginForm()
    {
        $view = \Tenant::isTenantRequest() ? 'tenant.auth.login' : 'system.auth.login';
        return view($view);
    }

    public function redirectPath()
    {
        return \Tenant::isTenantRequest() ?
            route('tenant.home', ['prefix' => \Request::route('prefix')]) :
            '/system/home';
    }

    /**
     * The user has logged out of the application.
     *
     * @param \Illuminate\Http\Request $request
     * @return mixed
     */
    protected function loggedOut(Request $request)
    {
        return \Tenant::isTenantRequest() ?
            redirect()->route('tenant.login', ['prefix' => \Request::route('prefix')]) :
            redirect()->route('system.login');
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        $guard = \Tenant::isTenantRequest() ? 'tenant':'system';
        return \Auth::guard($guard);
    }
}
