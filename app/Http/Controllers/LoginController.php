<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
   public function loginshow(){
        return view('login-page');
    }
    public function registershow(){
        return view('register-page');
    }
}
