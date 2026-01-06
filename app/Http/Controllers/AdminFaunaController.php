<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Fauna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminFaunaController extends Controller
{
    public function index()
    {
        return view('admin.fauna.index', [
            'fauna' => Fauna::where('approval_status', 'approved')->latest()->get()
        ]);
    }



    public function create()
    {
        return view('admin.fauna.create');
    }

    // METHOD STORE
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'scientific_name' => 'required',
            'habitat' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|max:2048'
        ]);

        $data = $request->all();
        $data['created_by'] = auth()->id();
        $data['approval_status'] = 'approved';

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('uploads', 'public');
        }

        Fauna::create($data);

        return redirect()->route('admin.fauna.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit(Fauna $fauna)
    {
        return view('admin.fauna.edit', compact('fauna'));
    }

    public function update(Request $request, Fauna $fauna)
    {
        $request->validate([
            'name' => 'required',
            'scientific_name' => 'required',
            'habitat' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|max:2048'
        ]);

        $data = $request->only([
            'name',
            'scientific_name',
            'habitat',
            'description',
            'status',
            'family'
        ]);

        if ($request->hasFile('image')) {
            if ($fauna->image_path) {
                Storage::disk('public')->delete($fauna->image_path);
            }
            $data['image_path'] = $request->file('image')->store('uploads', 'public');
        }

        $fauna->update($data);

        return redirect()->route('admin.fauna.index')
            ->with('success', 'Data berhasil diperbarui');
    }


    public function destroy(Fauna $fauna)
    {
        $fauna->delete();
        return back();
    }
}
