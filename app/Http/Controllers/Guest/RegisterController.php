<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
  public function top(){
    return view('toppage');
  }

  public function register(){
    return view('auth.register');
  }

  public function login(){
    return view('auth.login');
  }

}
