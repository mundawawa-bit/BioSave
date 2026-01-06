<?php

namespace App\Http\Controllers;

use App\Models\Flora;
use App\Models\Fauna;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // STAT CARD
        $floraCount = Flora::where('approval_status', 'approved')->count();
        $faunaCount = Fauna::where('approval_status', 'approved')->count();
        $userCount  = User::count();

        $pendingFlora  = Flora::where('approval_status', 'pending')->count();
        $pendingFauna  = Fauna::where('approval_status', 'pending')->count();
        $totalPending  = $pendingFlora + $pendingFauna;

        // TABEL DASHBOARD
        $latestFlora = Flora::with('creator')
            ->whereIn('approval_status', ['approved', 'pending', 'rejected'])
            ->latest()
            ->take(5)
            ->get();

        $latestFauna = Fauna::with('creator')
            ->whereIn('approval_status', ['approved', 'pending', 'rejected'])
            ->latest()
            ->take(5)
            ->get();

        $recents = $latestFlora
            ->concat($latestFauna)
            ->sortByDesc('created_at')
            ->take(5);

        return view('admin.dashboard', [
            'flora'   => $floraCount,
            'fauna'   => $faunaCount,
            'users'   => $userCount,
            'pending' => $totalPending,
            'recents' => $recents
        ]);
    }
}
