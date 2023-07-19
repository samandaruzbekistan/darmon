
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
    <link href="{{ asset('css/chart.css') }}" rel="stylesheet">
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




    <!-- Content Start -->
    <div class="content">
        <!-- Navbar Start -->
        <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
            <form class="d-none d-md-flex ms-4" >
                <input id="searchInput"
                    class="form-control border-0"
                    type="search"
                    placeholder="Qidirish"
                />
            </form>
            <div class="navbar-nav align-items-center ms-auto">
                <div class="nav-item">
                    <a
                        href="{{ route('reception_home') }}"
                        class="nav-link active"
                    >
                        <i class="fa fa-hospital me-lg-2"></i>
                        <span class="d-none d-lg-inline-flex">Bloglar</span>
                    </a>
                </div>
                <button class="btn btn-primary mx-2" onclick="logout()">
                    <i class="fa fa-sign-out-alt"></i>
                    Chiqish
                </button>
            </div>
        </nav>
        <!-- Navbar End -->

        <div class="container-fluid pt-4 px-4">
            <div class="row g-4">
                @foreach($blocks as $item)
                    <div class="col-sm-6 col-xl-3">
                    <div
                        class="bg-light rounded d-flex align-items-center justify-content-between p-4"
                    >
                        <h1 class="text-primary">{{ $item->letter }}</h1>
                        <a href="{{ route('showWard', ['id' => $item->id]) }}">
                            <div class="ms-3">
                                <p class="mb-2">{{ $item->name }}</p>
                                <h6 class="mb-0">Umumiy palatalar soni: <span>{{ $item->ward_count }}</span></h6>
                                <h6 class="mb-0">Bo'sh joylar soni: <span>{{ $item->space_count-$item->users_count }}</span></h6>
                            </div>
                        </a>
                        <div class="d-flex gap-1">
{{--                            <div class="pie animate" style="--p:90;--c:lightgreen"> 90%</div>--}}
{{--                            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editBlog">--}}
{{--                                <i class="bi bi-pencil-fill"></i>--}}
{{--                            </button>--}}
{{--                            </button>--}}
{{--                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addReport">--}}
{{--                                <i class="bi-clipboard"></i>--}}
{{--                            </button>--}}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>



        <!-- Search MODAL -->
        <div class="modal fade h-50" id="editBlog" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <input id="modalSearchInput" type="text" class="form-control" placeholder="Qidirish...">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body overflow-auto" id="modalReferences">

                    </div>
                </div>
            </div>
        </div>


        <!-- Back to Top -->
        <!-- <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a> -->

        <!-- Add new blog button -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top" data-bs-toggle="modal" data-bs-target="#addBlog"><i class="bi bi-plus"></i></a>
    </div>
</div>
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
    <script>
        $(document).ready(function() {
            // Show modal on search input click
            $('#searchInput').on('click', function() {
                $('#editBlog').modal('show');
            });

            // Handle form submission in modal
            $('#editBlog').on('click', '.btn-primary', function() {
                var blogName = $('#input1').val();
                var totalViews = $('#input3').val();

                // Perform further actions (e.g., AJAX request to save the changes)
                // ...

                // Close the modal
                $('#editBlog').modal('hide');
            });


            // Handle search input in modal
            $('#modalSearchInput').on('input', function() {
                var query = $(this).val();
                var loadingIndicator = $('#loadingIndicator');

                // Display the loading indicator
                loadingIndicator.show();

                // Make AJAX request to fetch search results
                $.ajax({
                    url: '{{ route('reception_search_users') }}', // Replace with your backend route for handling search
                    method: 'GET',
                    data: { name: query },
                    success: function(response) {
                        var references = response; // Assign the response directly
                        var referencesHtml = '';

                        // Loop through the references and generate HTML
                        for (var i = 0; i < references.length; i++) {
                            referencesHtml += '<p><i class="bi bi-person-fill"></i> F.I.Sh: ' + references[i].name + '</p>';
                            referencesHtml += '<p><i class="bi bi-house-fill"></i> Joylashuv: ' + references[i].block_name + ',' + references[i].ward_number + '-palata </p>';
                            referencesHtml += '<p><i class="bi bi-telephone-fill"></i> Telefon: ' + references[i].phone + '</p>';
                            // Add more fields as needed
                            referencesHtml += '<hr>';
                        }

                        // Display the references in the modal
                        $('#modalReferences').html(referencesHtml);

                        // Hide the loading indicator
                        loadingIndicator.hide();
                    },
                    error: function() {
                        // Handle error case
                        // Hide the loading indicator
                        loadingIndicator.hide();
                    }
                });

            });
        });
    </script>
    <!-- Template Javascript -->
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/modals.js') }}"></script>
</body>

</html>
