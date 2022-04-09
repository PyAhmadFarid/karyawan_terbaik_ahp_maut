<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class AuthController extends Controller
{
    //
    function index(){

        return view('login');
    }

    function login(Request  $request){
        // dd($request->genCre);
        $cre = $request->validate([
            "email" => "required",
            "password" => "required",
        ]);
        // dd($cre);
    
        if (Auth::attempt($cre,$request->get('remember'))) {
            return redirect()->intended('dashboard');
        }

        return redirect()->back()->with('gagal','anda tidak terdaftar');
    }

    function logout(){
        Session::flush();
        Auth::logout();

        return redirect()->route('home');
    }
}
