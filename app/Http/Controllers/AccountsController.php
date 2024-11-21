<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Hash;

class AccountsController extends Controller
{
    public function index(){
        if (auth()->check()) {
            return view('components.app-admin');
        } else {
            return redirect()->route('login');
        }
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
    public function registration(){
        return view('akun.register');
    }
    public function registrationAction(Request $request){
        $validasi = $request->validate([
            'username'=>'required|min:3|max:30',
            'email'=>'required|min:5|max:60',
            'password'=>'required|min:8',
        ]);

        $username = $request->input('username');
        $exists = User::where('username', $username)->exists();
        if ($exists) {
            return redirect()->back()->withErrors(['error' => 'Username has already been taken.']);
        } else {
            $user = new User();
            $user->username = $request->username;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();
            return redirect()->route('login')->withSuccess('User registered successfully.');
        }
    }
    public function logout(){
        Auth::logout();
        return redirect('login');
    }

    public function test(){
        dd(123);
    }
}
