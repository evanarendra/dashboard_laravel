<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login ()
    {
        if(Auth::check()) {
            return redirect()->intended('user/dashboard');
        }
        
        return view('login');
    }

    public function authenticate(Request $request)
    {
        // $credentials = $request->validate([
        //     'email' => 'required|email',
        //     'password' => 'required'
        // ]);

        // $rule = [
        //     'email' => 'required|email:users.email',
        //     'password' => 'required'
        // ];

        // $message = [
        //   'email.required' => 'Email harus diisi.',  
        //   'email.email' => 'Harus format email.',  
        //   'password.required' => 'password harus diisi.',  
        // ];

        // $validatedData = $request->validate($rule, $message);
        
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
    
        $credentials = $request->only('email', 'password');

        // if (Auth::attempt(['name' => $validatedData['email'], 'password' => Hash::make($validatedData['password'])]))
        if (Auth::attempt($credentials))
        {
            session()->regenerate();

            return redirect()->intended('user/dashboard')->withSuccess('You have successfully logged in!');
        }else

        return back()->withErrors($credentials);
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        return redirect('/login');
    }


    
}
