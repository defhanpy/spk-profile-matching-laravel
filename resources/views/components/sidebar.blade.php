<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/dashboard">
        <div class="sidebar-brand-icon rotate-n-15">
            <h2> <b>SPK</b> </h2>
        </div>
        <div class="sidebar-brand-text mx-3">Profile Matching<sup></sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="/dashboard">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Data Master -->
    <div class="sidebar-heading">
        Data Master
    </div>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="false" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Data Master</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar"
            style="">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Components:</h6>
                <a class=" collapse-item" href="{{ route('alternatif.index') }}">
                    <i class="fas fa-fw fa-list "></i>
                    <span>Data Alternatif</span>
                </a>
                <a class=" collapse-item" href="{{ route('kriteria.index') }}">
                    <i class="fas fa-fw fa-list "></i>
                    <span>Data Kriteria</span>
                </a>
                <a class="collapse-item" href="{{ route('subkriteria.index') }}">
                    <i class="fas fa-fw fa-sitemap "></i>
                    <span>Sub Kriteria</span>
                </a>
            </div>
        </div>

    <hr class="sidebar-divider">

<!-- Penilaian -->
<div class="sidebar-heading">
    Penilaian
</div>

<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProfil"
        aria-expanded="false" aria-controls="collapseProfil">
        <i class="fas fa-fw fa-user"></i>
        <span>Profil</span>
    </a>

    <div id="collapseProfil" class="collapse" aria-labelledby="headingProfil" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Menu Profil:</h6>

            <a class="collapse-item" href="{{ route('profilstandar.index') }}">
                <i class="fas fa-fw fa-list"></i>
                <span>Profil Standar</span>
            </a>

            <a class="collapse-item" href="{{ route('nilaiprofil.index') }}">
                <i class="fas fa-fw fa-edit"></i>
                <span>Nilai Profil</span>
            </a>

        </div>
    </div>
</li>

    <hr class="sidebar-divider">

    <!-- Perhitungan -->
    <div class="sidebar-heading">
        Perhitungan
    </div>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('profile-matching.index') }}">
            <i class="fas fa-fw fa-calculator"></i>
            <span>Profile Matching</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <!-- Hasil -->
    <div class="sidebar-heading">
        Hasil
    </div>


<li class="nav-item">
    <a class="nav-link" href="{{ route('ranking.index') }}">
        <i class="fas fa-fw fa-trophy"></i>
        <span>Ranking</span>
    </a>
</li>

{{--
    <hr class="sidebar-divider">

    <!-- Laporan -->
    <div class="sidebar-heading">
        Laporan
    </div>

    <li class="nav-item">
        <a class="nav-link" href="/laporan">
            <i class="fas fa-fw fa-file-alt"></i>
            <span>Laporan</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <!-- Pengaturan -->
    <div class="sidebar-heading">
        Pengaturan
    </div>

    <!-- User -->
    <li class="nav-item">
        <a class="nav-link" href="/user">
            <i class="fas fa-fw fa-user-cog"></i>
            <span>Manajemen User</span>
        </a>
    </li> --}}

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
