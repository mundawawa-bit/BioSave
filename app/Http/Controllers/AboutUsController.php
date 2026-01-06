<?php

namespace App\Http\Controllers;

use App\Models\AboutSetting;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    public function about()
    {
        // Ambil data setting.
        $about = AboutSetting::first();

        return view('public.aboutUs', compact('about'));
    }
}
