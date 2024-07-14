<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function registerForm():View{
        return view('frontend.user.register');
    }

    public function register(){
        return '';
    }
    public function loginForm():View{
        return view('frontend.user.login');
    }

    public function login(){
        return '';
    }
}
