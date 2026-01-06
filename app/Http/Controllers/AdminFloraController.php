<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Flora;
use Illuminate\Http\Request;

class AdminFloraController extends Controller
{
   public function index()
    {
        return view('admin.flora.index', [
            'flora' => Flora::where('approval_status', 'approved')->latest()->get()
        ]);
    }



    public function create()
    {
        return view('admin.flora.create');
    }

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

        // Handle Upload Gambar
        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('uploads', 'public');
        }

        Flora::create($data);

        return redirect()->route('admin.flora.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit(Flora $flora)
    {
        return view('admin.flora.edit', compact('flora'));
    }

    public function update(Request $request, Flora $flora)
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
            if ($flora->image_path) {
                Storage::disk('public')->delete($flora->image_path);
            }
            $data['image_path'] = $request->file('image')->store('uploads', 'public');
        }

        $fauna->update($data);

        return redirect()->route('admin.flora.index')
            ->with('success', 'Data berhasil diperbarui');
    }

    public function destroy(Flora $flora)
    {
        $flora->delete();
        return back();
    }
}
