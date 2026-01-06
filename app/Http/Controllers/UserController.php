<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('role', 'user');

        // Search
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', '%' . $search . '%')
                  ->orWhere('email', 'LIKE', '%' . $search . '%');
            });
        }

        $users = $query->latest()->paginate(10);

        return view('admin.dataAnggota', compact('users'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Hapus Foto Profil jika ada (agar penyimpanan tidak penuh)
        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
        }

        // Hapus Data User
        $user->delete();

        return redirect()->route('admin.dataAnggota.index')
            ->with('success', 'Anggota berhasil dihapus.');
    }
}
