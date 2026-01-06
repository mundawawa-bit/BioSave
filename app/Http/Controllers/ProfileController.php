<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function index()
    {
        return view('user.profile.index', [
            'user' => Auth::user()
        ]);
    }

    public function edit()
    {
        return view('user.profile.edit', [
            'user' => Auth::user()
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        // Validasi
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'phone' => 'nullable|string|max:20',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Max 2MB
        ]);

        // Update data text
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;

        // Cek apakah ada file avatar yang diupload
        if ($request->hasFile('avatar')) {
            // Hapus avatar lama jika ada (dan bukan default)
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }

            $path = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $path;
        }

        $user->save();

        return redirect()->route('user.profile')->with('success', 'Profil berhasil diperbarui!');
    }

    // 4. Update Password (Opsional/Terpisah)
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password lama salah']);
        }

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return back()->with('success', 'Password berhasil diubah');
    }
}
