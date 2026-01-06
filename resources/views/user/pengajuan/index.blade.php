@extends('components.layoutMain')

@section('title', 'Riwayat Pengajuan')

@section('styles')
<link rel="stylesheet" href="{{ asset('asset/pengajuan.css') }}">
@endsection

@section('content')

<h2 class="page-title">Riwayat Pengajuan Flora & Fauna</h2>

<a href="{{ route('user.submission.create') }}" class="btn-add">+ Ajukan Baru</a>

@if(session('success'))
    <div style="background:#dcfce7;color:#166534;padding:12px 16px;border-radius:10px;margin-bottom:20px;">
        {{ session('success') }}
    </div>
@endif

<div class="table-card">
<table>
    <thead>
        <tr>
            <th>Nama</th>
            <th>Jenis</th>
            <th>Status</th>
            <th>Tanggal</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
    @forelse($submissions as $item)
        <tr>
            {{-- NAMA --}}
            <td>
                <strong>{{ $item->name }}</strong><br>
                <small style="font-style:italic;color:#64748b;">
                    {{ $item->scientific_name ?? '-' }}
                </small>
            </td>

            {{-- JENIS --}}
            <td>{{ ucfirst($item->type) }}</td>

            {{-- STATUS --}}
            <td>
                @if($item->approval_status === 'pending')
                    <span class="status pending">Menunggu</span>
                @elseif($item->approval_status === 'approved')
                    <span class="status approved">Disetujui</span>
                @else
                    <span class="status rejected">Ditolak</span>
                @endif
            </td>

            {{-- TANGGAL --}}
            <td>{{ $item->created_at->format('d M Y') }}</td>

            {{-- AKSI --}}
            <td>
                <div style="display:flex; gap:6px; align-items:center; flex-wrap:wrap;">

                    {{-- DETAIL --}}
                    <button type="button"
                        class="btn-sm"
                        style="background:#3b82f6;color:white;border:none;cursor:pointer;"
                        onclick="showDetail(
                            '{{ $item->name }}',
                            '{{ $item->scientific_name ?? '-' }}',
                            '{{ ucfirst($item->type) }}',
                            '{{ $item->family ?? '-' }}',
                            '{{ $item->habitat ?? '-' }}',
                            '{{ $item->status ?? '-' }}',
                            '{{ ucfirst($item->approval_status) }}',
                            '{{ $item->created_at->format('d M Y') }}',
                            '{{ $item->description }}',
                            '{{ $item->image_path ? asset('storage/'.$item->image_path) : '' }}'
                        )">
                        Detail
                    </button>

                    {{-- ===== PENDING ===== --}}
                    @if($item->approval_status === 'pending')

                        <a href="{{ route('user.submission.edit', [$item->type, $item->id]) }}"
                           class="btn-edit">
                            Edit
                        </a>

                        <form action="{{ route('user.submission.destroy', [$item->type, $item->id]) }}"
                              method="POST"
                              onsubmit="return confirm('Yakin ingin menghapus pengajuan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete">Hapus</button>
                        </form>

                    {{-- ===== REJECTED ===== --}}
                    @elseif($item->approval_status === 'rejected')

                        <form action="{{ route('user.submission.destroy', [$item->type, $item->id]) }}"
                              method="POST"
                              onsubmit="return confirm('Pengajuan ditolak. Hapus data?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete">Hapus</button>
                        </form>

                    {{-- ===== APPROVED ===== --}}
                    @else

                        <button type="button"
                            class="btn-edit"
                            onclick="alert('Pengajuan sudah disetujui.\nSilakan hubungi admin untuk perubahan.')">
                            Edit
                        </button>

                        <button type="button"
                            class="btn-delete"
                            onclick="alert('Pengajuan sudah disetujui.\nData tidak dapat dihapus.')">
                            Hapus
                        </button>

                        <i class="fa-solid fa-lock"
                           style="color:#cbd5e1;"
                           title="Pengajuan terkunci"></i>

                    @endif

                </div>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="5" style="text-align:center;color:#94a3b8;padding:30px;">
                Belum ada pengajuan.
            </td>
        </tr>
    @endforelse
    </tbody>
</table>
</div>

{{-- ================= MODAL DETAIL ================= --}}
<div id="detailModal" class="modal-overlay" onclick="closeDetail(event)">
    <div class="modal-box">
        <div class="modal-header">
            <h3 id="modalName">Detail Pengajuan</h3>
            <button onclick="closeDetailButton()">&times;</button>
        </div>

        <div class="modal-body">

            <img id="modalImage"
                 style="display:none;width:100%;border-radius:10px;margin-bottom:15px;">
            <p id="noImageText"
               style="display:none;text-align:center;color:#94a3b8;">
               Tidak ada gambar
            </p>

            <div class="detail-row"><span>Nama Ilmiah</span><strong id="modalLatin"></strong></div>
            <div class="detail-row"><span>Jenis</span><strong id="modalType"></strong></div>
            <div class="detail-row"><span>Famili</span><strong id="modalFamily"></strong></div>
            <div class="detail-row"><span>Habitat</span><strong id="modalHabitat"></strong></div>
            <div class="detail-row"><span>Status Konservasi</span><strong id="modalStatus"></strong></div>
            <div class="detail-row"><span>Status Pengajuan</span><strong id="modalApproval"></strong></div>
            <div class="detail-row"><span>Tanggal Pengajuan</span><strong id="modalDate"></strong></div>

            <div style="margin-top:15px;">
                <strong>Deskripsi</strong>
                <p id="modalDesc" style="margin-top:6px;line-height:1.6;"></p>
            </div>

        </div>
    </div>
</div>

<script>
function showDetail(
    name, latin, type, family, habitat,
    status, approval, date, desc, image
) {
    document.getElementById('modalName').innerText = name;
    document.getElementById('modalLatin').innerText = latin;
    document.getElementById('modalType').innerText = type;
    document.getElementById('modalFamily').innerText = family;
    document.getElementById('modalHabitat').innerText = habitat;
    document.getElementById('modalStatus').innerText = status;
    document.getElementById('modalApproval').innerText = approval;
    document.getElementById('modalDate').innerText = date;
    document.getElementById('modalDesc').innerText = desc;

    const img = document.getElementById('modalImage');
    const noImg = document.getElementById('noImageText');

    if (image) {
        img.src = image;
        img.style.display = 'block';
        noImg.style.display = 'none';
    } else {
        img.style.display = 'none';
        noImg.style.display = 'block';
    }

    document.getElementById('detailModal').style.display = 'flex';
}

function closeDetailButton() {
    document.getElementById('detailModal').style.display = 'none';
}

function closeDetail(e) {
    if (e.target.id === 'detailModal') {
        closeDetailButton();
    }
}
</script>

@endsection
