<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        // Se o papel for cliente, valida telefone
        if (($data['role'] ?? 'cliente') === 'cliente') {
            return \Validator::make($data, [
                'name' => ['required', 'string', 'max:255'],
                'telefone' => ['required', 'string', 'max:20', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
        } else {
            // Barbeiro ou admin
            return \Validator::make($data, [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
        }
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        if (($data['role'] ?? 'cliente') === 'cliente') {
            return User::create([
                'name' => $data['name'],
                'telefone' => $data['telefone'],
                'password' => \Hash::make($data['password']),
                'role' => 'cliente',
            ]);
        } else {
            return User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => \Hash::make($data['password']),
                'role' => $data['role'] ?? 'barbeiro',
            ]);
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
}
