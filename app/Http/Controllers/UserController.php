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

            toast('Login Sukses', 'success')->background('#050505')->width('24rem');
            return redirect('/');
        }
        toast('Login gagal, periksa email atau password', 'error')->background('#050505')->width('24rem');
        return back()->withErrors([
            'email' => 'Invalid Login Credentials.',
        ])->onlyInput('email');
    }

    // logout user
    public function logout(Request $request)
    {
        Auth::logout();

        toast('Logout Sukses', 'success')->background('#050505')->width('24rem');
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

        toast('Berhasil register, Selamat Datang!!', 'success')->background('#050505')->width('24rem');
        return redirect('/');
    }
}
