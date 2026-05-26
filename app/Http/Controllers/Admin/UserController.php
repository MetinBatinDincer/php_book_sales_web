<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function edit(User $user)
    {
        $this->ensureEditable($user);

        return view('admin.users.form', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $this->ensureEditable($user);

        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:160', Rule::unique('users', 'email')->ignore($user->id)],
            'address' => ['nullable', 'string'],
            'wallet_balance' => ['required', 'numeric', 'min:0'],
            'status' => ['required', Rule::in(['active', 'passive'])],
        ]);

        $user->update($data);

        return redirect()->route('admin.dashboard')->with('success', 'Kullanici guncellendi.');
    }

    public function status(Request $request, User $user)
    {
        $this->ensureEditable($user);

        $data = $request->validate([
            'status' => ['required', Rule::in(['active', 'passive'])],
        ]);

        $user->update(['status' => $data['status']]);

        return redirect()->route('admin.dashboard')->with('success', 'Kullanici durumu guncellendi.');
    }

    public function destroy(User $user)
    {
        $this->ensureEditable($user);

        try {
            $user->delete();

            return redirect()->route('admin.dashboard')->with('success', 'Kullanici silindi.');
        } catch (QueryException) {
            return redirect()->route('admin.dashboard')->with('warning', 'Siparisi bulunan kullanici silinemez; hesap dondurulabilir.');
        }
    }

    private function ensureEditable(User $user): void
    {
        abort_if($user->isAdmin(), 404);
    }
}

