<?php

namespace App\Http\Controllers;

use App\Models\AboutSetting;
use Illuminate\Http\Request;

class AboutSettingController extends Controller
{

    public function index()
    {
        // Ambil data pertama, atau buat objek baru kosong jika belum ada
        $about = AboutSetting::first() ?? new AboutSetting();

        return view('admin.aboutSetting', compact('about'));
    }

    // Simpan perubahan
    public function update(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'description'  => 'required',
            'vision'       => 'required',
            'mission'      => 'required',
            'email'        => 'nullable|email',
            'phone'        => 'nullable|string',
            'address'      => 'nullable|string',
        ]);

        AboutSetting::updateOrCreate(
            ['id' => 1], // Kunci pencarian
            $request->all() // Data yang diupdate
        );

        return redirect()->back()->with('success', 'Profil website berhasil diperbarui!');
    }
}
