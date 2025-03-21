<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function showRegister() {
        return view('user.register');   
    }

    // register user

    public function register(Request $request) {
        // dd($request);
        $data = $request->validate([
            'name' =>  'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed'    
        ],[
            'password.confirmed' => 'Password does not match the confirm password'
        ]);

        $user = User::create($data);

        Auth::login($user);
        return redirect()->route('post.create');
    }



    // Login form
    public function showLogin() {
        return view('user.login');
    }


    // Login user
    public function login(Request $request) {
        $data = $request->validate([
            'email' => 'required|email',
            "password" => 'required|string', 
        ]);

        if(Auth::attempt($data)) {
            $request->session()->regenerate();
            return redirect()->intended(route('post.create'));
        }
        return back()->with('error','Invalid credentials');

    }

    // change password form
    public  function showChangePassword() {
        return view('user.changePassword');
    }


    // Change password 
    public function changePassword(Request $request) {
        // dd($request);

        $request -> validate([
            'current_password' => [
                'required',
                'string',
            function($attribute, $value, $fail) {
                if(!Hash::check($value,Auth::user()->password)) {
                    return $fail('Current password does not match');
                }
            } 
        ],
            'new_password' => 'required|string|min:8|confirmed',
            'new_password_confirmation' => 'required|string'
        ]);

        Auth::user()->update([
            // 'password' => Hash::make($request->new_password)
            'password' => $request->new_password
        ]);

        return redirect()->route('post.create')->with('success','Password changed successfully');

    }


    // Logout user
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('showLogin');
    }

}

