<!-- resources/views/layouts/sidebar.blade.php -->
<div style="padding: 10px;height: 100vh;">
    <div style="box-shadow: none;border-radius:25px;height:100%;" id="layout-menu"
        class="layout-menu menu-vertical menu bg-menu-theme">
        <div class="app-brand demo">
            <a href="#" class="app-brand-link">
                <span class="app-brand-logo demo">
                    <img src="{{ url('/assets') }}/img/amti-logo-transparent.png" alt="AMTI Logo">
                </span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large d-block d-xl-none">
                <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
        </div>

        <div class="menu-inner-shadow"></div>

        <ul class="menu-inner py-1">
            @canany(['isSuperAdmin', 'isAdminGSI'])
            <li class="menu-item">
                <a href="{{ url('/dashboard') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-home-circle"></i>
                    <div data-i18n="dashboard">Home</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ url('/parameter') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-cog"></i>
                    <div data-i18n="parameter">Default Sensor</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ url('/client_sensor') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-list-check"></i>
                    <div data-i18n="parameter">Sensor Client</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ url('/vendor') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bxs-user-detail "></i>
                    <div data-i18n="vendor">Manage User</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ url('/user') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-grid"></i>
                    <div data-i18n="user">Manage Account</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ url('/admin') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bxs-user-badge"></i>
                    <div data-i18n="vendor">Manage Admin</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ url('/report') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-download"></i>
                    <div data-i18n="report">Download Data</div>
                </a>
            </li>
            @endcan
            @canany(['isAdminVendor', 'isUser'])
            <li class="menu-item">
                <a href="javascript:void(0)" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-home-circle"></i>
                    <div data-i18n="Extended UI">Home</div>
                </a>
                <ul class="menu-sub" id="loc-lists">

                </ul>
            </li>
            <li class="menu-item">
                <a href="{{ url('/report') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-download"></i>
                    <div data-i18n="report">Download Data</div>
                </a>
            </li>

            @endcan
        </ul>
        <div style="padding: 20px;">
            <center>
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn"
                    style="background: #f37d14fa;color: white;">
                    <i class="bx bx-power-off me-2"></i>
                    <span class="align-middle">Log Out</span>
                </a>
            </center>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>

    </div>
</div>