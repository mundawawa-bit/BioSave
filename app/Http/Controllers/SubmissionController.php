<?php

namespace App\Http\Controllers;

use App\Models\Flora;
use App\Models\Fauna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SubmissionController extends Controller
{

    public function index()
    {
        $userId = Auth::id();

        $floras = Flora::where('created_by', $userId)
            ->latest()
            ->get()
            ->map(function ($item) {
                $item->type = 'flora';
                return $item;
            });

        $faunas = Fauna::where('created_by', $userId)
            ->latest()
            ->get()
            ->map(function ($item) {
                $item->type = 'fauna';
                return $item;
            });

        $submissions = $floras
            ->merge($faunas)
            ->sortByDesc('created_at')
            ->values();

        return view('user.pengajuan.index', compact('submissions'));
    }

    public function create()
    {
        return view('user.pengajuan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type'            => 'required|in:flora,fauna',
            'name'            => 'required|string|max:255',
            'scientific_name' => 'required|string|max:255',
            'family'          => 'nullable|string|max:255',
            'habitat'         => 'required|string|max:255',
            'status'          => 'nullable|string|max:255',
            'description'     => 'required',
            'image'           => 'required|image|max:2048',
        ]);

        $data = [
            'created_by'      => Auth::id(),
            'name'            => $request->name,
            'scientific_name' => $request->scientific_name,
            'family'          => $request->family,
            'habitat'         => $request->habitat,
            'status'          => $request->status,
            'description'     => $request->description,
            'image_path'      => $request->file('image')->store('uploads', 'public'),
            'approval_status' => 'pending',
        ];

        $request->type === 'flora'
            ? Flora::create($data)
            : Fauna::create($data);

        return redirect()
            ->route('user.submission.index')
            ->with('success', 'Pengajuan berhasil dikirim.');
    }

    public function edit($type, $id)
    {
        $type = strtolower($type);

        $model = $type === 'flora'
            ? Flora::where('created_by', Auth::id())->findOrFail($id)
            : Fauna::where('created_by', Auth::id())->findOrFail($id);

        if ($model->approval_status === 'rejected') {
            abort(403, 'Pengajuan yang ditolak tidak dapat diedit.');
        }

        if ($model->approval_status === 'approved') {
            return redirect()
                ->route('user.submission.index')
                ->with('error', 'Pengajuan sudah diproses. Untuk perubahan silakan hubungi admin.');
        }

        return view('user.pengajuan.edit', [
            'data' => $model,
            'type' => $type
        ]);
    }

    public function update(Request $request, $type, $id)
    {
        $type = strtolower($type);

        $model = $type === 'flora'
            ? Flora::where('created_by', Auth::id())->findOrFail($id)
            : Fauna::where('created_by', Auth::id())->findOrFail($id);

        if ($model->approval_status !== 'pending') {
            return redirect()
                ->route('user.submission.index')
                ->with('error', 'Pengajuan tidak dapat diedit.');
        }

        $request->validate([
            'name'            => 'required|string|max:255',
            'scientific_name' => 'nullable|string|max:255',
            'family'          => 'nullable|string|max:255',
            'habitat'         => 'required|string|max:255',
            'status'          => 'nullable|string|max:255',
            'description'     => 'required',
            'image'           => 'nullable|image|max:2048',
        ]);

        $model->update($request->only([
            'name',
            'scientific_name',
            'family',
            'habitat',
            'status',
            'description'
        ]));

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($model->image_path);
            $model->image_path = $request->file('image')->store('uploads', 'public');
            $model->save();
        }

        return redirect()
            ->route('user.submission.index')
            ->with('success', 'Pengajuan berhasil diperbarui.');
    }

    public function destroy($type, $id)
    {
        $type = strtolower($type);

        $model = $type === 'flora'
            ? Flora::where('created_by', Auth::id())->findOrFail($id)
            : Fauna::where('created_by', Auth::id())->findOrFail($id);

        if ($model->approval_status === 'approved') {
            return redirect()
                ->route('user.submission.index')
                ->with('error', 'Pengajuan sudah disetujui. Silakan hubungi admin.');
        }

        Storage::disk('public')->delete($model->image_path);
        $model->delete();

        return redirect()
            ->route('user.submission.index')
            ->with('success', 'Pengajuan berhasil dihapus.');
    }
}
