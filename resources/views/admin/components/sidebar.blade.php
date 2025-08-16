@php
    function is_active_query($route, $params = [], $class = 'active') {
        if (!request()->is($route)) return '';

        foreach ($params as $key => $value) {
            if (request()->query($key) != $value) return '';
        }

        return $class;
    }
@endphp

<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center mt-4 mb-2" href="/">
        <div class="sidebar-brand-icon">
            <img width="70" height="70" src="{{ asset('sb-admin-2/img/logo_favicon2.png') }}" alt="logo">
        </div>
        <div class="sidebar-brand-text" style="font-size: 14px">Victory Auto</div>
    </a>

    <li class="nav-item {{ request()->is('/') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.app') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Data Master
    </div>

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->is('master/mobil*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.mobil') }}">
            <i class="fas fa-fw fa-car"></i>
            <span>Data Mobil</span></a>
    </li>

    <li class="nav-item {{ request()->is('master/paket*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.paket') }}">
            <i class="fas fa-fw fa-box"></i>
            <span>Paket Kredit</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Pelanggan
    </div>

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->is('pelanggan/pembeli*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.pembeli') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>Pembeli</span></a>
    </li>

    <li class="nav-item {{ request()->is('pelanggan/cicilan*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.cicilan') }}">
            <i class="fas fa-fw fa-calendar-alt"></i>
            <span>Cicilan</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Transaksi Penjualan
    </div>

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ is_active_query('order*', ['type_pembayaran' => 'cash']) }}">
        <a class="nav-link" href="{{ route('admin.pembelian') }}?type_pembayaran=cash">
            <i class="fas fa-fw fa-money-bill-wave"></i>
            <span>Cash</span></a>
    </li>

    <li class="nav-item {{ is_active_query('order*', ['type_pembayaran' => 'kredit']) }}">
        <a class="nav-link" href="{{ route('admin.pembelian') }}?type_pembayaran=kredit">
            <i class="fas fa-fw fa-file-invoice-dollar"></i>
            <span>Kredit</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->is('report*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.report') }}">
            <i class="fas fa-fw fa-file-alt"></i>
            <span>Laporan</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
