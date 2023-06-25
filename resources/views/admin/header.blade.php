
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Control panel</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('css/style-admin.css') }}" rel="stylesheet">
    <link href="{{ asset('css/cards-admin.css') }}" rel="stylesheet">
</head>

<body>
<div class="container-fluid position-relative bg-white d-flex p-0">
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Yuklanmoqda...</span>
        </div>
    </div>
    <!-- Spinner End -->


    <!-- Sidebar Start -->
    <div class="sidebar pe-4 pb-3">
        <nav class="navbar bg-light navbar-light">
            <a href="{{ route('admin_home') }}" class="navbar-brand mx-4 mb-3">
                <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>DARMON</h3>
            </a>
            <div class="navbar-nav w-100">
                <a href="{{ route('admin_home') }}" class="nav-item nav-link @yield('home')"><i class="fa fa-tachometer-alt me-2"></i>Bosh menu</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Elements</a>
                    <div class="dropdown-menu bg-transparent border-0">
                        <a href="{{ route('doctors') }}" class="dropdown-item">Shifokorlar</a>
                        <a href="typography.html" class="dropdown-item">Typography</a>
                        <a href="element.html" class="dropdown-item">Other Elements</a>
                    </div>
                </div>
                <a href="{{ route('admin_blocks') }}" class="nav-item nav-link  @yield('blocks')"><i class="fa fa-table me-2"></i>Bloklar</a>
                <a href="{{ route('admin_wards', ['block_id' => 'all', 'type' => 'all', 'status' => 'all']) }}" class="nav-item nav-link  @yield('wards')"><i class="fas fa-th-large me-2"></i>Palatalar</a>
                <a href="{{ route('doctors') }}" class="nav-item nav-link"><i class="fas fa-user-md me-2"></i>Shifokorlar</a>
                <a href="widget.html" class="nav-item nav-link"><i class="fas fa-sign-out-alt me-2"></i>Qabulxona</a>
                <a href="widget.html" class="nav-item nav-link"><i class="fas fa-notes-medical me-2"></i>Hamshiralar</a>

                <a href="chart.html" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>Charts</a>
            </div>
        </nav>
    </div>
    <!-- Sidebar End -->

    <!-- Content Start -->
    <div class="content">
        <!-- Navbar Start -->
        <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
            <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
            </a>
            <a href="#" class="sidebar-toggler flex-shrink-0">
                <i class="fa fa-bars"></i>
            </a>
            <form class="d-none d-md-flex ms-4">
                <input class="form-control border-0" type="search" placeholder="Qidiruv...">
            </form>
            <div class="navbar-nav align-items-center ms-auto">
                <div class="nav-item">
                    <a
                        href="#"
                        class="nav-link active"
                    >
                        <i class="fa fa-hospital"></i>
{{--                        <span class="d-none d-lg-inline-flex">Blog-C</span>--}}
                    </a>
                </div>
                <a href="{{ route('admin_logout') }}">
                    <button class="btn btn-primary mx-2">
                        <i class="fa fa-sign-out-alt"></i>
                        Chiqish
                    </button>
                </a>
            </div>
        </nav>
        <!-- Navbar End -->



        @yield('section')




    </div>
    <!-- Content End -->

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('lib/chart/chart.min.js') }}"></script>
    <script src="{{ asset('lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('lib/tempusdominus/js/moment.min.js') }}"></script>
    <script src="{{ asset('lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
    <script src="{{ asset('lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>
