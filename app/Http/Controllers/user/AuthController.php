<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index() {
        return view('user.auth-form');
    }

    public function handleLogin() {

    }

    public function handleRegister() {

    }
}
