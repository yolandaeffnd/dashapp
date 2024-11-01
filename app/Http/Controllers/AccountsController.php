<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountsController extends Controller
{
    public function index(){
        return view('components.app-admin');
    }
    public function login(){
        return view('akun.login');
    }
    public function loginAction(Request $request){
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $remember = $request->has('remember');
        if (Auth::attempt($request->only('username', 'password'), $remember)) {
            return redirect()->route('index');
        }
        return redirect()->back()->withErrors(['error' => 'Username or Password is incorrect.']);
    }
}
