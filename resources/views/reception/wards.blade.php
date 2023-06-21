
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>DARMON - Qabulxona</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="{{ asset('img/favicon.ico') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/cards.css') }}" rel="stylesheet">
</head>

<body>
<div class="container-fluid position-relative bg-white d-flex p-0">
    <!-- Spinner Start -->
    <div
        id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center"
    >
        <div
            class="spinner-border text-primary"
            style="width: 3rem; height: 3rem"
            role="status"
        >
            <span class="sr-only">Yuklanmoqda...</span>
        </div>
    </div>
    <!-- Spinner End -->

    <!-- Content Start -->
    <div class="content">
        <!-- Navbar Start -->
        <nav
            class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0"
        >
            <form class="d-none d-md-flex ms-4">
                <input
                    class="form-control border-0"
                    type="search"
                    placeholder="Search"
                />
            </form>
            <div class="navbar-nav align-items-center ms-auto">
                <div class="nav-item">
                    <a
                        href="./sections.html"
                        class="nav-link active"
                    >
                        <i class="fa fa-hospital me-lg-2"></i>
                        <span class="d-none d-lg-inline-flex">Bloglar</span>
                    </a>
                </div>
                <button class="btn btn-primary mx-2">
                    <i class="fa fa-sign-out-alt"></i>
                    Chiqish
                </button>
            </div>
        </nav>
        <!-- Navbar End -->

        <!-- Button Start -->
        <div class="container-fluid pt-4 px-4">
            <div class="card-container">
                <div class="card">
                    <div class="card-count-container">
                        <div class="card-count full">111</div>
                    </div>

                    <div class="card-content text-center">
                        <h4>Palata nomi</h4>
                        <p>Palata turi</p>
                    </div>

                    <div class="card-footer text-center full">
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editRoom">
                            <i class="bi bi-pencil-fill"></i>
                        </button>
                        </button>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addReport">
                            <i class="bi-clipboard"></i>
                        </button>
                    </div>
                </div>

                <div class="card">
                    <div class="card-count-container">
                        <div class="card-count half">2</div>
                    </div>
                    <div class="card-content text-center">
                        <h4>Palata nomi</h4>
                        <p>Palata turi</p>
                    </div>

                    <div class="card-footer text-center half">
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editRoom">
                            <i class="bi bi-pencil-fill"></i>
                        </button>
                        </button>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addReport">
                            <i class="bi-clipboard"></i>
                        </button>
                    </div>
                </div>

                <div class="card">
                    <div class="card-count-container">
                        <div class="card-count free">3</div>
                    </div>
                    <div class="card-content text-center">
                        <h4>Palata nomi</h4>
                        <p>Palata turi</p>
                    </div>

                    <div class="card-footer text-center free">
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editRoom">
                            <i class="bi bi-pencil-fill"></i>
                        </button>
                        </button>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addReport">
                            <i class="bi-clipboard"></i>
                        </button>
                    </div>
                </div>
                <div class="card">
                    <div class="card-count-container">
                        <div class="card-count free">4</div>
                    </div>
                    <div class="card-content text-center">
                        <h4>Palata nomi</h4>
                        <p>Palata turi</p>
                    </div>

                    <div class="card-footer text-center free">
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editRoom">
                            <i class="bi bi-pencil-fill"></i>
                        </button>
                        </button>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addReport">
                            <i class="bi-clipboard"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Button End -->

        <!-- EDIT ROOM MODAL -->
        <div class="modal fade" id="editRoom" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Palata ma'lumotlarini tahrirlash</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="input1" class="form-label">Palata nomi</label>
                            <input type="text" class="form-control" id="input1">
                        </div>
                        <div class="mb-3">
                            <label for="input2" class="form-label">Palata turi</label>
                            <select name="selectDoctor" id="input2" class="form-select">
                                <option value="">Oddiy</option>
                                <option value="">Statsionar</option>
                                <option value="">Karantin</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="input3" class="form-label">Umumiy joylar soni</label>
                            <input type="number" class="form-control" id="input3">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bekor qilish</button>
                            <button type="button" class="btn btn-primary">Saqlash</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ADD ROOM MODAL -->
        <div class="modal fade" id="addRoom" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Yangi palata qo'shish</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="input1" class="form-label">Palata nomi</label>
                            <input type="text" class="form-control" id="input1">
                        </div>
                        <div class="mb-3">
                            <label for="input2" class="form-label">Palata turi</label>
                            <select name="selectDoctor" id="input2" class="form-select">
                                <option value="">Oddiy</option>
                                <option value="">Statsionar</option>
                                <option value="">Karantin</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="input3" class="form-label">Umumiy joylar soni</label>
                            <input type="number" class="form-control" id="input3">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bekor qilish</button>
                            <button type="button" class="btn btn-primary">Saqlash</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ADD REPORT MODAL -->
        <div class="modal fade" id="addReport" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Hisobot kiritish</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="input1" class="form-label">Palata nomi</label>
                            <input type="text" class="form-control" id="input1">
                        </div>
                        <div class="mb-3">
                            <label for="input2" class="form-label">Shifokor ism-familiyasi</label>
                            <select name="selectDoctor" id="input2" class="form-select">
                                <option value="">Doktor Haus</option>
                                <option value="">Doktor Jamshid</option>
                                <option value="">Doktor Doniyor</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="input3" class="form-label">Hisobot</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bekor qilish</button>
                            <button type="button" class="btn btn-primary">Saqlash</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Content End -->

    <!-- Back to Top -->
    <!-- <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"
      ><i class="bi bi-arrow-up"></i
    ></a> -->

    <!-- Add new room button -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top" data-bs-toggle="modal" data-bs-target="#addRoom"><i class="bi bi-plus"></i></a>
</div>

<!-- JavaScript Libraries -->
<script>
    function logout() {
        window.location="{{ route('logout_reception') }}";
    }
</script>
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
<script src="{{ asset('js/modals.js') }}"></script>
</body>

</html>
