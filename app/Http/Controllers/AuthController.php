<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // Menampilkan Halaman Login
    public function LoginForm()
    {
        return view('auth.login');
    }

    // Proses Login
    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            // Regenerate session untuk keamanan
            $request->session()->regenerate();

            // Cek Role User
            $user = Auth::user();

            if ($user->role === 'admin') {
                // Jika Admin -> ke Dashboard Admin
                return redirect()->route('admin.dashboard');
            } else {
                // Jika User -> ke Dashboard User (Landing Page User)
                return redirect()->route('user.home');
            }
        }

        // Kalo Login Gagal
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    // Menampilkan Halaman Register
    public function RegisterForm()
    {
        return view('auth.register');
    }

    // Proses Register
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:6',
        ]);

        // Create User Baru
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Enkripsi password
            'role' => 'user', // Default role user
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    // Proses Logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
