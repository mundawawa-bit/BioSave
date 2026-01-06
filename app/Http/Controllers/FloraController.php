<?php

namespace App\Http\Controllers;

use App\Models\Flora;

class FloraController extends Controller
{
    public function index()
    {
        $flora = Flora::with('creator')->where('approval_status', 'approved')->latest()->get();
        return view('public.flora.index', compact('flora'));
    }

    public function show(Flora $flora)
    {
        if ($flora->approval_status !== 'approved' && !auth()->check()) {
            abort(404);
        }

        return view('public.flora.show', compact('flora'));
    }

}
