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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    public function username()
    {
        $login = request()->input('login');
        // Se for só números, assume telefone (cliente)
        if (preg_match('/^\d+$/', $login)) {
            return 'telefone';
        }
        return 'email';
    }

    protected function credentials(Request $request)
    {
        $login = $request->input('login');
        if (preg_match('/^\d+$/', $login)) {
            return [
                'telefone' => $login,
                'password' => $request->input('password'),
                'role' => 'cliente',
            ];
        } else {
            return [
                'email' => $login,
                'password' => $request->input('password'),
            ];
        }
    }

    protected function redirectTo()
    {
        $user = auth()->user();
        if ($user->isAdmin()) {
            return '/admin';
        } elseif ($user->isBarbeiro()) {
            return '/barbeiro';
        } else {
            return '/cliente';
        }
    }

    protected function validateLogin(Request $request)
    {
        $role = $request->input('role');
        if ($role === 'cliente') {
            $request->validate([
                'login' => ['required', 'string'],
                'password' => ['required', 'string'],
            ]);
        } else {
            $request->validate([
                'login' => ['required', 'string', 'email'],
                'password' => ['required', 'string'],
            ]);
        }
    }
}
