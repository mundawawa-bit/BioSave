<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Flora;
use App\Models\Fauna;

class ApprovalController extends Controller
{
    public function index()
{
    return view('admin.konfirmasiPengajuan', [
        'flora' => Flora::where('approval_status', 'pending')
            ->whereNotNull('created_by')
            ->latest()
            ->get(),

        'fauna' => Fauna::where('approval_status', 'pending')
            ->whereNotNull('created_by')
            ->latest()
            ->get(),
    ]);
}

public function approveFlora(Flora $flora)
{
    $flora->update(['approval_status' => 'approved']);
    return back()->with('success', 'Pengajuan flora disetujui');
}

public function approveFauna(Fauna $fauna)
{
    $fauna->update(['approval_status' => 'approved']);
    return back()->with('success', 'Pengajuan fauna disetujui');
}

public function rejectFlora(Flora $flora)
{
    $flora->update(['approval_status' => 'rejected']);
    return back()->with('success', 'Pengajuan flora ditolak');
}

public function rejectFauna(Fauna $fauna)
{
    $fauna->update(['approval_status' => 'rejected']);
    return back()->with('success', 'Pengajuan fauna ditolak');
}

}
