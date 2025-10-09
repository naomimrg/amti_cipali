<!DOCTYPE html>
<html lang="en" class="light-style layout-compact" dir="ltr" data-theme="theme-default" data-assets-path="assets/"
    data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>{{ config('app.name') }} | @yield('title')</title>
    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ url('/assets') }}/img/amti-logo-transparent.pn" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{ url('/assets') }}/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ url('/assets') }}/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ url('/assets') }}/vendor/css/theme-default.css"
        class="template-customizer-theme-css" />
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

    <!-- <style>
        .layout-menu-fixed:not(.layout-menu-collapsed) .layout-page,
        .layout-menu-fixed-offcanvas:not(.layout-menu-collapsed) .layout-page {
            padding-left: 0;
        }
    </style> -->
    @yield('style')
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            @include('layouts.sidebar')
            <div class="content-wrapper">
                <!-- Content -->
                <div class="container-xxl flex-grow-1 container-p-y" style="padding-top:10px!important;">
                    <div class="row">
                        <!-- <div class="col-12">
                            <p><label style="display:none;" class="hl"></label>Show: <span style="color: black;"
                                    id="datenow"></span></p>
                        </div> -->
                        @yield('content')
                        <div class="content-backdrop fade"></div>
                    </div>
                    <!-- Content wrapper -->
                </div>
                <!-- / Layout page -->
            </div>
            <!-- Overlay -->
            <div class="layout-overlay layout-menu-toggle"></div>
        </div>
    </div>
    <!-- / Layout wrapper -->


    <!-- Core JS -->
    <!-- build:js {{ url('/assets') }}/vendor/js/core.js -->

    <!--<script src="{{ url('/assets') }}/vendor/libs/jquery/jquery.js"></script>-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
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

    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="{{ url('/assets') }}/js/sweetalert2.all.min.js"></script>
    <script type='text/javascript'>
    var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober',
        'November', 'Desember'
    ];
    var myDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum&#39;at', 'Sabtu'];
    var date = new Date();
    var day = date.getDate();
    var month = date.getMonth();
    var thisDay = date.getDay(),
        thisDay = myDays[thisDay];
    var yy = date.getYear();
    var year = (yy < 1000) ? yy + 1900 : yy;
    $('#datenow').html(thisDay + ', ' + day + ' ' + months[month] + ' ' + year);
    </script>
    @can('isAdminVendor')
    <script>
    $.getJSON("{{ url('/getLoc') }}", function(data) {
        const baseHome = "{{ url('/home') }}"; // <- tidak ada spasi
        $.each(data.items, function(i, item) {
            $('#loc-lists').append(
                `<li class="menu-item">
         <a href="${baseHome}/${item.slug}" class="menu-link">${item.nama_lokasi}</a>
       </li>`
            );
        });
    });
    </script>
    @endcan
    @yield('script')
</body>

</html>