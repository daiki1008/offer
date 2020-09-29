<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReserchController extends Controller
{
  public function reserch(){
    return view('admin.reserch.index');
  }
}
