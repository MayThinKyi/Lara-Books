<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
    //
    public function home(){
        if(Auth::user()->role!='admin'){
            return back();
        }else{
     return redirect()->route('category#list');

        }
    }
}
