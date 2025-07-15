<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class LogoutController extends Controller
{
    public function index(){
        Auth::logout();

        return redirect()->route('login')->with(['status'=>'success','sms' =>'Logout Successfully']);
    }
}
