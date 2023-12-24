<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // index - for admin
    public function index(Request $request): View
    {
        $this->authorize('user_index');

        $search = $request->input('search');

        $users = User::where('name', 'like', "%$search%")
            ->orWhere('email', 'like', "%$search%")
            ->paginate(10);

        return view('pages.admin.user.index', [
            'users' => $users
        ]);
    }

    // edit - for admin
    public function edit(User $user): View
    {
        $this->authorize('user_edit');
        return view('pages.admin.user.edit', [
            'user' => $user
        ]);
    }

    // update - for admin
    public function update(Request $request, User $user)
    {
        $this->authorize('user_edit');
        $formFields = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'is_admin' => 'required|boolean',
            'updated_at' => now()
        ]);
        $update = $user->update($formFields);
        if ($update) {
            toast('Berhasil update user', 'success')->background('#050505')->width('24rem');
            return redirect()->route('user.index');
        }
        toast('Gagal update user', 'error')->background('#050505')->width('24rem');
        return back();
    }

    // delete - for admin
    public function destroy(User $user)
    {
        $this->authorize('user_delete');
        $user->delete();

        toast('Berhasil hapus user', 'success')->background('#050505')->width('24rem');
        return redirect()->route('user.index');
    }

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
