<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\User;



class AuthController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth', ['except' => ['login','register']]);
    // }

    public function register() {
        return view('admin.auth.register-form');
    }

    public function handleRegister(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'password_confirmation' => 'same:password|min:6'
        ]);
        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            
        ]);

        return redirect(route('admin.login'));

    }

    public function login() {
        return view('admin.auth.login-form');
    }

    public function handleLogin(Request $request) {
        $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ]);

        $credentials = $request->only('email', 'password');

        if(Auth::guard('web') -> attempt($credentials)) {
            $request->session()->regenerate();
            return redirect(route('admin.dashboard'));
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function handelLogout (Request $request) {
        if(Auth::guard('web') -> check()){
            Auth::guard('web') -> logout();
        }
       
        return redirect(route('admin.login'));
    }
}
