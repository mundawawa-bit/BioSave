<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Flora;
use App\Models\Fauna;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil 3 data flora dan fauna terbaru yang sudah diapprove
        $flora = Flora::where('approval_status', 'approved')->latest()->take(3)->get();
        $fauna = Fauna::where('approval_status', 'approved')->latest()->take(3)->get();

        return view('public.landingPage', [
            'flora' => $flora,
            'fauna' => $fauna
        ]);
    }
}
