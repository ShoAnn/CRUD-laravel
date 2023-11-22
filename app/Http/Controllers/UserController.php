<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // show login form page
    public function login()
    {
        return view('pages.auth.login');
    }

    // authenticate user
    public function authenticate(Request $request)
    {
        $formFields = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($formFields)) {
            $request->session()->regenerate();

            return redirect('/')->with('success', 'You are logged in!');
        }
        return back()->withErrors([
            'email' => 'Invalid Email',
        ])->onlyInput('email');
    }

    // logout user
    public function logout(Request $request)
    {
        Auth::logout();

        return redirect('/login');
    }

    // show register form page
    public function register()
    {
        return view('pages.auth.register');
    }

    // create new user
    public function create(Request $request)
    {
        $formFields = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:8',
        ]);

        $formFields['password'] = bcrypt($formFields['password']);

        $user = User::create($formFields);

        Auth::login($user);

        return redirect('/');
    }
}
