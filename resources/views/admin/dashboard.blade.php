@extends('components.layoutAdmin')

@section('title', 'Dashboard')

@section('styles')
    <link rel="stylesheet" href="{{ asset('asset/dashboard.css') }}">
@endsection

@section('content')

{{-- ================= STAT CARDS ================= --}}
<div class="stats">

    <div class="stat-card">
        <h3>Total Flora</h3>
        <strong>{{ $flora }}</strong>
    </div>

    <div class="stat-card">
        <h3>Total Fauna</h3>
        <strong>{{ $fauna }}</strong>
    </div>

    <div class="stat-card">
        <h3>Total User</h3>
        <strong>{{ $users }}</strong>
    </div>

    <div class="stat-card">
        <h3>Menunggu Konfirmasi</h3>
        <strong>{{ $pending }}</strong>
    </div>

</div>

{{-- ================= TABLE ================= --}}
<div class="table-card">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
        <h2>Pengajuan Terbaru</h2>
    </div>

    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Jenis</th>
                <th>Diajukan Oleh</th>
                <th>Status</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
        @forelse($recents as $item)
            <tr>
                {{-- Nama --}}
                <td><strong>{{ $item->name }}</strong></td>

                {{-- Jenis --}}
                <td>
                    @if($item instanceof \App\Models\Flora)
                        <span style="color:#1b5e20; font-weight:bold;">Flora</span>
                    @else
                        <span style="color:#b45309; font-weight:bold;">Fauna</span>
                    @endif
                </td>

                {{-- Diajukan Oleh --}}
                <td>
                    {{ optional($item->creator)->name ?? 'Admin' }}
                </td>

                {{-- Status --}}
                <td>
                    @if($item->approval_status === 'approved')
                        <span class="status approved">Disetujui</span>
                    @elseif($item->approval_status === 'rejected')
                        <span class="status rejected">Ditolak</span>
                    @else
                        <span class="status pending">Menunggu</span>
                    @endif
                </td>

                {{-- Tanggal --}}
                <td style="font-size:12px; color:#6b7280;">
                    {{ $item->created_at->diffForHumans() }}
                </td>

                {{-- Aksi --}}
                <td>
                    @if($item->approval_status === 'pending')
                        <a href="{{ route('admin.konfirmasiPengajuan.index') }}"
                           class="btn-action"
                           style="text-decoration:none;">
                            Review
                        </a>

                    @elseif($item->approval_status === 'approved')
                        @if($item instanceof \App\Models\Flora)
                            <a href="{{ route('admin.flora.index') }}"
                               class="btn-action"
                               style="text-decoration:none;">
                                Detail
                            </a>
                        @else
                            <a href="{{ route('admin.fauna.index') }}"
                               class="btn-action"
                               style="text-decoration:none;">
                                Detail
                            </a>
                        @endif

                    @else
                        <span style="color:#9ca3af;">-</span>
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" style="text-align:center; padding:20px; color:#9ca3af;">
                    Belum ada data pengajuan terbaru.
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>

@endsection
