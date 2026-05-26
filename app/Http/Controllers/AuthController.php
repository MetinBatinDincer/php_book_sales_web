<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $credentials['status'] = 'active';

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended(
                Auth::user()->isAdmin() ? route('admin.dashboard') : route('home')
            );
        }

        return back()
            ->withInput($request->only('email'))
            ->with('danger', 'E-posta veya sifre hatali.');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:160', 'unique:users,email'],
            'address' => ['nullable', 'string'],
            'password' => ['required', 'string', 'min:6'],
        ]);

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'address' => $data['address'] ?? '',
            'password' => $data['password'],
            'role' => 'user',
            'status' => 'active',
        ]);

        return redirect()->route('login')->with('success', 'Kayit tamamlandi. Oturum acabilirsiniz.');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}

