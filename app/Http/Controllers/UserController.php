<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function showRegister(){
        return view('user.register');   
    }
    public function register(Request $request){
        // dd($request);
        $data = $request->validate([
            'name' =>  'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed'    
        ],[
            'password.confirmed' => 'Password does not match the confirm password'
        ]);

        $user = User::create($data);

        // Auth::login($user);
        return redirect()->route('post.create');
    }

    public function showLogin(){
        return view('user.login');
    }

    public function login(Request $request){
        $data = $request->validate([
            'email' => 'required|email',
            "password" => 'required|string', 
        ]);

        if(Auth::attempt($data)){
            return redirect()->route('post.create');
        }

        return back()->with('error','Invalid credentials');

    }

    public function logout(){
        //
    }

}

