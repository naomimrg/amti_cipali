<!DOCTYPE html>

<html
    lang="en"
    class="light-style layout-compact"
    dir="ltr"
    data-theme="theme-default"
    data-assets-path="assets/"
    data-template="vertical-menu-template-free">
    <head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>{{ config('app.name') }} | @yield('title')</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ url('/assets') }}/img/gsi-logo-transparent.png" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;600&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="{{ url('/assets') }}/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ url('/assets') }}/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ url('/assets') }}/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ url('/assets') }}/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ url('/assets') }}/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="{{ url('/assets') }}/vendor/libs/apex-charts/apex-charts.css" />

    <!-- Page CSS -->
    <link rel="stylesheet" href="{{ url('/assets') }}/css/custom.css" />
    <!-- Helpers -->
    <script src="{{ url('/assets') }}/vendor/js/helpers.js"></script>
    <script src="{{ url('/assets') }}/js/config.js"></script>
    <link rel="stylesheet" type="text/css" href="{{ url('/assets') }}/css/sweetalert2.min.css">
    <style>
      .layout-menu-fixed:not(.layout-menu-collapsed) .layout-page, .layout-menu-fixed-offcanvas:not(.layout-menu-collapsed) .layout-page{
        padding-left: 0;
      }
    </style>
    @yield('style')
</head>

<body style="background-color: #F2F2F2;">
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
        <div id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme" style="box-shadow: none; height: 100%;">
            <div class="app-brand-link justify-content-center mt-4 mb-4">
              <img src="{{ url('/assets') }}/img/logo1.png">
            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            @canany(['isSuperAdmin','isAdminGSI'])
            <li class="menu-item {{ request()->is('dashboard') ? 'active' : '' }}">
              <a href="{{ url('/dashboard')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div class="nunito-font">Home</div>
              </a>
            </li>
            <li class="menu-item {{ request()->is('parameter') ? 'active' : '' }}">
              <a href="{{ url('/parameter')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-cog"></i>
                <div class="nunito-font">Default Sensor</div>
              </a>
            </li>
            <li class="menu-item {{ request()->is('client_sensor') ? 'active' : '' }}">
              <a href="{{ url('/client_sensor')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-list-check"></i>
                <div class="nunito-font">Sensor Client</div>
              </a>
            </li>
            <li class="menu-item {{ request()->is('vendor') ? 'active' : '' }}">
              <a href="{{ url('/vendor')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-user-detail"></i>
                <div class="nunito-font">Manage User</div>
              </a>
            </li>
            <li class="menu-item {{ request()->is('user') ? 'active' : '' }}">
              <a href="{{ url('/user')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-grid"></i>
                <div class="nunito-font">Manage Account</div>
              </a>
            </li>
            <li class="menu-item {{ request()->is('admin') ? 'active' : '' }}">
              <a href="{{ url('/admin')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-user-badge"></i>
                <div class="nunito-font">Manage Admin</div>
              </a>
            </li>
            <li class="menu-item {{ request()->is('report') ? 'active' : '' }}">
              <a href="{{ url('/report')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-download"></i>
                <div class="nunito-font">Download Data</div>
              </a>
            </li>
            @endcan

            @canany(['isAdminVendor','isUser'])
            <li class="menu-item">
              <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div class="nunito-font">Home</div>
              </a>
              <ul class="menu-sub" id="loc-lists"></ul>
            </li>
            <li class="menu-item {{ request()->is('report') ? 'active' : '' }}">
              <a href="{{ url('/report')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-download"></i>
                <div class="nunito-font">Download Data</div>
              </a>
            </li>
            
            @endcan
            <li class="menu-item">
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
                class="menu-link nunito-font">
                <i class="bx bx-power-off me-2"></i> Log Out
              </a>
            </li>
          </ul>
        
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
            </form>
        </div>
        <!-- end menu -->

        <div class="layout-page">
        <!-- Navbar -->
          <nav class="layout-navbar navbar navbar-expand-xl ms-4 align-items-center bg-navbar-theme w-99" id="layout-navbar">
            <div class="container-fluid d-flex justify-content-between">
              <!-- Toggle Menu for Mobile -->
              <div class="layout-menu-toggle navbar-nav align-items-center me-3 d-xl-none">
                <a class="nav-item nav-link px-0" href="javascript:void(0)">
                  <i class="bx bx-menu bx-sm"></i>
                </a>
              </div>

              <!-- Search Bar -->
              <div class="d-flex align-items-center flex-grow-1">
                <div class="layout-menu-toggle navbar-nav align-items-center me-3 d-none d-sm-block">
                  <i class="bx bx-menu bx-sm"></i>
              </div>

                <div class="navbar-nav align-items-center flex-grow-1 mx-3" style="border-radius: 13px; padding-left: 10px; background: #f3f3f3;">
                  <div class="nav-item d-flex align-items-center w-100">
                    <i class="bx bx-search fs-4 lh-0"></i>
                    <input type="text" class="form-control border-0 shadow-none ps-2 bg-transparent w-100" placeholder="Search..." aria-label="Search...">
                  </div>
                </div>
              </div>

              <!-- Notification & User Profile -->
              <ul class="navbar-nav flex-row align-items-center ms-auto">
                <li class="nav-item lh-1 me-3">
                  <i class='bx bx-sm bx-bell'></i>
                </li>
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online" id="avatar-logo-top"></div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item" href="#">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online" id="avatar-logo-bottom"></div>
                          </div>
                          <div class="flex-grow-1">
                            <span class="fw-medium d-block">{{ Auth::user()->name }}</span>
                            <small class="text-muted">{{ Auth::user()->email }}</small>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="{{ url('/profile')}}">
                        <i class="bx bx-user me-2"></i>
                        <span class="align-middle">My Profile</span>
                      </a>
                    </li>
                  </ul>
                </li>
              </ul>
            </div>
          </nav>
        <!-- end navbar -->

        <!-- Content -->
          <div class="container-fluid d-flex flex-column flex-grow-1">
            <div class="row">
              <div class="col-12 py-3 m-2">
                <!-- <p><label style="display:none;" class="hl"></label>Show: <span style="color: black;" id="datenow"></span></p> -->
                @yield('content')
              </div>
            </div>
          </div>
        <!-- end Content -->

        <!-- Footer -->
        <div class="content-backdrop fade"></div>
        </div>
          <!-- end footer -->
    </div>
        <!-- / Layout page -->

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->


    <!-- Core JS -->
    <!-- build:js {{ url('/assets') }}/vendor/js/core.js -->

    <!--<script src="{{ url('/assets') }}/vendor/libs/jquery/jquery.js"></script>-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="{{ url('/assets') }}/vendor/libs/popper/popper.js"></script>
    <script src="{{ url('/assets') }}/vendor/js/bootstrap.js"></script>
    <script src="{{ url('/assets') }}/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="{{ url('/assets') }}/vendor/js/menu.js"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ url('/assets') }}/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="{{ url('/assets') }}/js/main.js"></script>

    <!-- Page JS -->
    <script src="{{ url('/assets') }}/js/dashboards-analytics.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="{{ url('/assets') }}/js/sweetalert2.all.min.js"></script>
    <!-- <script type='text/javascript'>
        var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        var myDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum&#39;at', 'Sabtu'];
        var date = new Date();
        var day = date.getDate();
        var month = date.getMonth();
        var thisDay = date.getDay(),
            thisDay = myDays[thisDay];
        var yy = date.getYear();
        var year = (yy < 1000) ? yy + 1900 : yy;
        $('#datenow').html(thisDay + ', ' + day + ' ' + months[month] + ' ' + year);

    </script> -->
    @can('isAdminVendor')

    <script>
       $.ajax({
          url: "{{ url('/getLoc') }}",
          dataType: "json",
          success: function (data) {
            $.each(data.items, function(index, item) {
              $('#loc-lists').append('<li class="menu-item"><a href="{{ url("/home")}}/'+item.slug+'" class="menu-link"><div data-i18n="'+item.nama_lokasi+'">'+item.nama_lokasi+'</div></a></li>');
            });
          }
      });
    </script>
    @endcan
    @yield('script')
    <script>
    $.ajax({
        url: "{{ url('/getProfile') }}",
        dataType: "json",
        success: function (data) {

            $('#avatar-logo-top').append('<img src="{{ url("/assets") }}/img/'+data.image+'" alt class="w-px-40 h-auto rounded-circle" />');
            $('#avatar-logo-bottom').append('<img src="{{ url("/assets") }}/img/'+data.image+'" alt class="w-px-40 h-auto rounded-circle" />');
        }
    });
	  </script>
  </body>
</html>
