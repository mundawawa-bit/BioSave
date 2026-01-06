<div class="sidebar">

    <div class="brand">
        Admin BioSave
    </div>

    <div class="mt-3 d-flex flex-column" style="height: calc(100vh - 100px); justify-content: space-between;">

        <div>
            <a href="{{ route('admin.dashboard') }}"
               class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-chart-line"></i> Dashboard
            </a>

            <a href="{{ route('admin.flora.index') }}"
               class="{{ request()->routeIs('admin.flora.*') ? 'active' : '' }}">
                <i class="fa-solid fa-leaf"></i> Kelola Flora
            </a>

            <a href="{{ route('admin.fauna.index') }}"
               class="{{ request()->routeIs('admin.fauna.*') ? 'active' : '' }}">
                <i class="fa-solid fa-paw"></i> Kelola Fauna
            </a>

            <a href="{{ route('admin.konfirmasiPengajuan.index') }}"
               class="{{ request()->routeIs('admin.pengajuan.*') ? 'active' : '' }}">
                <i class="fa-solid fa-check-to-slot"></i> Konfirmasi Pengajuan
            </a>

            <a href="{{ route('admin.dataAnggota.index') }}"
               class="{{ request()->routeIs('admin.dataAnggota.*') ? 'active' : '' }}">
                <i class="fa-solid fa-users"></i> Data Anggota
            </a>

            <a href="{{ route('admin.about.index') }}"
               class="{{ request()->routeIs('admin.about.*') ? 'active' : '' }}">
                <i class="fa-solid fa-gear"></i> Setting About Us
            </a>
        </div>

        <div class="mb-4">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" onclick="return confirm('Yakin ingin logout?')"
                        style="width: 100%; text-align: left; background: #dc3545; color: white; padding: 12px 20px; border: none; border-radius: 8px; font-weight: 500; cursor: pointer; transition: 0.3s;">
                    <i class="fa-solid fa-right-from-bracket me-2"></i> Keluar
                </button>
            </form>
        </div>

    </div>
</div>
