<?php

namespace App\Http\Controllers;

use App\Models\Fauna;

class FaunaController extends Controller
{
    public function index()
    {
        $fauna = Fauna::with('creator')->where('approval_status', 'approved')->latest()->get();
        return view('public.fauna.index', compact('fauna'));
    }

   public function show(Fauna $fauna)
    {
        if ($fauna->approval_status !== 'approved' && !auth()->check()) {
            abort(404);
        }

        return view('public.fauna.show', compact('fauna'));
    }

}
