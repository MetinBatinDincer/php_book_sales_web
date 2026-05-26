<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function edit(Request $request)
    {
        return view('profile.edit', ['user' => $request->user()]);
    }

    public function update(Request $request)
    {
        $user = $request->user();

        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:160', Rule::unique('users', 'email')->ignore($user->id)],
            'address' => ['nullable', 'string'],
            'password' => ['nullable', 'string', 'min:6'],
        ]);

        $user->fill([
            'name' => $data['name'],
            'email' => $data['email'],
            'address' => $data['address'] ?? '',
        ]);

        if (! empty($data['password'])) {
            $user->password = $data['password'];
        }

        $user->save();

        return back()->with('success', 'Bilgileriniz guncellendi.');
    }

    public function deactivate(Request $request)
    {
        $user = $request->user();

        if (! $user->isAdmin()) {
            $user->update(['status' => 'passive']);
        }

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('warning', 'Uyelik pasif hale getirildi.');
    }
}

