@extends('components.layoutAdmin')

@section('title', 'Konfirmasi Pengajuan')

@section('styles')
    <link rel="stylesheet" href="{{ asset('asset/konfirmasi-pengajuan.css') }}">
@endsection

@section('content')

<h2 class="page-title">Konfirmasi Pengajuan Flora & Fauna</h2>

<div class="table-card">
    <table>
        <thead>
            <tr>
                <th>Nama User</th>
                <th>Nama Spesies</th>
                <th>Jenis</th>
                <th>Status</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>

        {{-- ================= FLORA ================= --}}
        @forelse($flora as $item)
        <tr>
            <td>
                {{ optional($item->creator)->name ?? 'User tidak tersedia' }}
            </td>
            <td><strong>{{ $item->name }}</strong></td>
            <td><span style="color:#166534;font-weight:bold;">Flora</span></td>
            <td><span class="status pending">Menunggu</span></td>
            <td>{{ $item->created_at->format('d M Y') }}</td>
            <td>
                <div style="display:flex;gap:5px;">

                    {{-- DETAIL --}}
                    <button type="button" class="btn btn-detail"
                        onclick="showDetail(
                            '{{ $item->name }}',
                            '{{ $item->scientific_name ?? '-' }}',
                            'Flora',
                            '{{ $item->family ?? '-' }}',
                            '{{ $item->description }}',
                            '{{ $item->image_path ? asset('storage/'.$item->image_path) : '' }}',
                            '{{ optional($item->creator)->name ?? 'User tidak tersedia' }}'
                        )">
                        Detail
                    </button>

                    <form action="{{ route('admin.approval.approveFlora', $item->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-approve"
                            onclick="return confirm('Setujui pengajuan ini?')">
                            Terima
                        </button>
                    </form>

                    <form action="{{ route('admin.approval.rejectFlora', $item->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-reject"
                            onclick="return confirm('Tolak pengajuan ini?')">
                            Tolak
                        </button>
                    </form>

                </div>
            </td>
        </tr>
        @empty
        @endforelse

        {{-- ================= FAUNA ================= --}}
        @forelse($fauna as $item)
        <tr>
            <td>
                {{ optional($item->creator)->name ?? 'User tidak tersedia' }}
            </td>
            <td><strong>{{ $item->name }}</strong></td>
            <td><span style="color:#b45309;font-weight:bold;">Fauna</span></td>
            <td><span class="status pending">Menunggu</span></td>
            <td>{{ $item->created_at->format('d M Y') }}</td>
            <td>
                <div style="display:flex;gap:5px;">

                    {{-- DETAIL --}}
                    <button type="button" class="btn btn-detail"
                        onclick="showDetail(
                            '{{ $item->name }}',
                            '{{ $item->scientific_name ?? '-' }}',
                            'Fauna',
                            '{{ $item->family ?? '-' }}',
                            '{{ $item->description }}',
                            '{{ $item->image_path ? asset('storage/'.$item->image_path) : '' }}',
                            '{{ optional($item->creator)->name ?? 'User tidak tersedia' }}'
                        )">
                        Detail
                    </button>

                    <form action="{{ route('admin.approval.approveFauna', $item->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-approve"
                            onclick="return confirm('Setujui pengajuan ini?')">
                            Terima
                        </button>
                    </form>

                    <form action="{{ route('admin.approval.rejectFauna', $item->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-reject"
                            onclick="return confirm('Tolak pengajuan ini?')">
                            Tolak
                        </button>
                    </form>

                </div>
            </td>
        </tr>
        @empty
        @endforelse

        @if($flora->isEmpty() && $fauna->isEmpty())
            <tr>
                <td colspan="6" style="text-align:center;padding:40px;">
                    Tidak ada pengajuan.
                </td>
            </tr>
        @endif

        </tbody>
    </table>
</div>

{{-- ================= MODAL DETAIL ================= --}}
<div id="detailModal" class="modal-overlay" onclick="closeDetail(event)">
    <div class="modal-box">
        <div class="modal-header">
            <h3 id="modalName">Nama Spesies</h3>
            <button class="close-modal" onclick="closeDetailButton()">&times;</button>
        </div>

        <div class="modal-body">
            <img id="modalImage" style="display:none;">
            <p id="noImageText" style="display:none;text-align:center;color:#999;">
                Tidak ada gambar
            </p>

            <div class="detail-row">
                <span class="detail-label">Pengaju:</span>
                <span class="detail-value" id="modalUser"></span>
            </div>

            <div class="detail-row">
                <span class="detail-label">Nama Latin:</span>
                <span class="detail-value" id="modalLatin" style="font-style:italic;"></span>
            </div>

            <div class="detail-row">
                <span class="detail-label">Kategori:</span>
                <span class="detail-value" id="modalType"></span>
            </div>

            <div class="detail-row">
                <span class="detail-label">Famili:</span>
                <span class="detail-value" id="modalFamily"></span>
            </div>

            <div class="detail-desc">
                <strong>Deskripsi:</strong><br>
                <span id="modalDesc"></span>
            </div>
        </div>
    </div>
</div>

{{-- ================= JAVASCRIPT ================= --}}
<script>
function showDetail(name, latin, type, family, desc, image, user) {
    document.getElementById('modalName').innerText = name;
    document.getElementById('modalLatin').innerText = latin;
    document.getElementById('modalType').innerText = type;
    document.getElementById('modalFamily').innerText = family;
    document.getElementById('modalDesc').innerText = desc;
    document.getElementById('modalUser').innerText = user;

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

function closeDetail(event) {
    if (event.target.id === 'detailModal') {
        closeDetailButton();
    }
}
</script>

@endsection
