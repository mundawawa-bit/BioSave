<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller; // Pastikan import Controller
use App\Models\Flora;
use App\Models\Fauna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserHomeController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // Flora yang diajukan oleh user login
        $recentFlora = Flora::where('approval_status', 'approved')->where('created_by', $userId)->latest()->take(3)->get();

        // Fauna yang diajukan oleh user login
        $recentFauna = Fauna::where('approval_status', 'approved')->where('created_by', $userId)->latest()->take(3)->get();

        return view('user.landingPage', [
            'flora' => $recentFlora,
            'fauna' => $recentFauna
        ]);
    }
}

