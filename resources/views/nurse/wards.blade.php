
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>DARMON - Qabulxona</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    {{--    <link href="{{ asset('img/favicon.ico') }}" rel="icon">--}}

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
    {{--    <link href="{{ asset('css/cards.css') }}" rel="stylesheet">--}}
    <link href="{{ asset('css/cards-admin.css') }}" rel="stylesheet">


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
        <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
            <form class="d-none d-md-flex ms-4">
                <input class="form-control border-0" id="searchInput" type="search" placeholder="Search">
            </form>
            <h5 class="navbar-nav m-auto">{{ session('nurse_name') }}</h5>
            <div class="navbar-nav align-items-center ms-auto">
                <div class="nav-item">
                    <a href="{{ route('nurse_home') }}" class="nav-link active">
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
            <div class="row cards-container">
                @foreach($wards as $ward)
                    <div class="col-md-4 col-sm-6 col-lg-2 btn-card" id="{{ $ward->id }}" data-action="{{ $ward->block_id }}" style="cursor: pointer">
                        <div class="card p-3 mb-2" >
                            <div class="d-flex justify-content-between">
                                <div class="d-flex flex-row align-items-center">
                                    <div class="icon">
                                        <p class="text-muted">{{ $ward->number }}</p>
                                    </div>
                                    <div class="ms-2 c-details">
                                        <p class="mb-0">Palata</p>
                                    </div>
                                </div>
                                <div class="col-3" >
                                    <img src="{{ asset('logo1.png') }}" class="img-fluid">
                                </div>
                            </div>
                            <div class="mt-4">
                                <p class="room-name">Turi: {{ $ward->type }}</p>
                                <p class="room-type">Bo'sh joy: {{ $ward->space_count - $ward->users_count }} ta</p>
                                <div class="mt-4">
                                    @if($ward->users_count / $ward->space_count * 100 == 0)
                                        <div class="progress">
                                            <div class="progress-bar " role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    @elseif($ward->users_count / $ward->space_count * 100 == 100)
                                        <div class="progress">
                                            <div class="progress-bar full" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    @else
                                        <div class="progress">
                                            <div class="progress-bar half" role="progressbar" style="width: {{ $ward->users_count / $ward->space_count * 100 }}%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
        <!-- Button End -->


        <div class="modal fade" id="showPatients" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 id="message" class="text-primary">Palatadagi bemorlar</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="modalReferences">

                    </div>
                </div>
            </div>
        </div>
        <form action="{{ route('remove_patient') }}" method="post" style="display: none">
            @csrf
            <input type="hidden" name="user_id" id="user_id_input" value="0">
            <button type="submit" id="sb-btn">s</button>
        </form>

        @if(session()->has('backData'))
            @switch(session('backData'))
                @case(1)
                    <div class="modal" id="errorModal" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4>Muvaffaqaiyatli!</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-success" id="modalReferences">
                                    Bemor tizimga kiritildi!
                                </div>
                            </div>
                        </div>
                    </div>
                    @break
                @case(0)
                    <div class="modal   " id="errorModal" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 id="message" class="text-danger">Xatolik!</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body" id="modalReferences">
                                    Bu ismdagi bemor tizimda mavjud!
                                </div>
                            </div>
                        </div>
                    </div>
                    @break
                @case(3)
                    <div class="modal   " id="errorModal" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 id="message" class="text-success">Muvaffaqaiyatli!</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body" id="modalReferences">
                                    Bemor malumotlari o'zgartirildi
                                </div>
                            </div>
                        </div>
                    </div>
                    @break
                @case(4)
                    <div class="modal   " id="errorModal" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 id="message" class="text-success">Muvaffaqaiyatli!</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body" id="modalReferences">
                                    Bemor tizimdan chiqarib yuborildi
                                </div>
                            </div>
                        </div>
                    </div>
                    @break
            @endswitch
        @endif
        <div class="modal  fade " id="success" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 id="message" class="text-success">Muvaffaqiyatli!</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="modalReferences">
                        Bemor bazaga kiritildi!
                    </div>
                </div>
            </div>
        </div>
        <!-- ADD PATIENT MODAL -->

    </div>
    <!-- Content End -->
    <div class="modal fade" id="addPatient" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ma'lumotlarni taxrirlash</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="createPatientForm" action="{{ route('edit_patient') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="namePatient" class="form-label">F.I.SH</label> <sup class="text-danger">*</sup>
                            <input readonly required name="name" type="text" class="form-control" id="namePatient">
                        </div>
                        <div class="mb-3 row">
                            <div class="col-6">
                                <select name="block_id" class="form-select" id="block" aria-label="Default select example">
                                    <option selected>Blok</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <select class="form-select" name="ward_id" id="ward" aria-label="Default select example">
                                    <option selected>Palata</option>
                                </select>
                            </div>
                        </div>
                        <div class="row" id="tyil">
                            <div class="mb-3 col-sm-6">
                                <label for="phone" class="form-label">Telefon raqami</label> <sup class="text-danger">*</sup>
                                <input name="phone" required type="number" pattern=".{5,}" class="form-control" id="phone">
                            </div>
                            <div class="mb-3 col-sm-6">
                                <label for="phone2" class="form-label">Yaqinlari telefoni</label> <sup class="text-danger">*</sup>
                                <input name="phone2" required type="number" class="form-control" id="phone2">
                            </div>
                        </div>
                        <input type="hidden" name="user_id" value="0" id="user_id"/>
                        <div class="mb-3 row">
                            <div class="col-6">
                                <label for="leaveDate" class="form-label">Kelgan sanasi</label> <sup class="text-danger">*</sup>
                                <input readonly type="date" min="{{ date('Y-m-d') }}" max="{{ date('Y-m-d', strtotime('+30 days')) }}" name="departure_date" required class="form-control" id="kelgan">
                            </div>
                            <div class="col-6">
                                <label for="leaveDate" class="form-label">Ketish sanasi</label> <sup class="text-danger">*</sup>
                                <input type="date" min="{{ date('Y-m-d') }}" max="{{ date('Y-m-d', strtotime('+30 days')) }}" name="departure_date" required class="form-control" id="ketgan">
                            </div>

                        </div>
                        <input type="submit" id="submit" style="display: none">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bekor qilish</button>
                    <button type="submit" class="btn btn-primary" onclick="submitBtn()">Saqlash</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Back to Top -->
    <!-- <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"
      ><i class="bi bi-arrow-up"></i
    ></a> -->

    <!-- Add new room button -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top" data-bs-toggle="modal" data-bs-target="#addRoom"><i class="bi bi-plus"></i></a>
</div>
<!-- Search MODAL -->
<div class="modal fade h-50" id="editBlog" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <input id="modalSearchInput" type="text" class="form-control" placeholder="Qidirish...">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body overflow-auto" id="modalReferences2">

            </div>
        </div>
    </div>
</div>

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
    function submitBtn() {
        document.getElementById('submit').click();
    }
    $(document).on('click', ".remove-user", function() {
        let userID = $(this).attr('id');
        $('#user_id_input').val(userID);
        if (confirm("Haqiqatdan ham ushbu bemornin tizimdan chiqarmoqchimisiz?") == true) {
            document.getElementById('sb-btn').click();
        } else {
            return false;
        }
    });

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
                url: '{{ route('nurse_search_users') }}', // Replace with your backend route for handling search
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
                    $('#modalReferences2').html(referencesHtml);

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

    $(window).on('load', function() {
        $('#errorModal').modal('show');
    });

    $(document).on('click', ".edit-btn", function() {
        let userID = $(this).attr('id');
        $.ajax({
            url: '{{ route('getPatientById') }}/' + userID, // Replace with your backend route for handling search
            method: 'GET',
            success: function (response) {
                if(response[0].is_uzbekistan === 1){
                    $('#showPatients').modal('hide');
                    $('#namePatient').val(response[0].name);
                    $('#phone').val(response[0].phone);
                    $('#phone2').val(response[0].phone2);
                    $('#user_id').val(response[0].id);
                    $('#kelgan').val(response[0].arrival_date);;
                    $('#ketgan').val(response[0].departure_date);
                    $("#block").empty();
                    $.each(response[1], function(key, value){
                        if(value.id === response[0].block_id){
                            $('#block').append('<option value="' + value.id+ '" selected>' + value.name + '</option>');
                        }
                        else{
                            $('#block').append('<option value="' + value.id+ '">' + value.name + '</option>');
                        }
                    });
                    $("#ward").empty();
                    $.each(response[2], function(key, value){
                        if(value.id === response[0].ward_id){
                            $('#ward').append('<option value="' + value.id+ '" selected>' + value.number + '-palata</option>');
                        }
                        else{
                            $('#ward').append('<option value="' + value.id+ '">' + value.number + '-palata</option>');
                        }
                    });
                    $('#addPatient').modal('show');
                    console.log(response.name)
                }
            }
        });
    });

    $(document).on('change', '#block', function() {
        let selectedId = $(this).val();

        $("#ward").empty();
        // $('#ward').append('<option value="" disabled selected>Tanlash...</option>');
        $.ajax({
            url: '{{ route('getWardById') }}/' + selectedId,
            method: 'GET',
            success: function(data) {
                $("#ward").empty();
                // $('#ward').append('<option value="" disabled selected>Tanlash...</option>');
                $.each(data, function(key, value){
                    $('#ward').append('<option value="' + value.id+ '">' + value.number + '-palata</option>');
                });
            }
        });
    });

    $(document).on('click', ".btn-card", function() {
        $('#showPatients').modal('show');
        let cardID = $(this).attr('id');
        let blockID = $(this).attr('data-action');
        $('#ward_id').val(cardID);
        $('#block_id').val(blockID);
        // Display the loading indicator
        $.ajax({
            url: '{{ route('nurse_get_users') }}/' + cardID, // Replace with your backend route for handling search
            method: 'GET',
            success: function(response) {
                var references = response; // Assign the response directly
                var referencesHtml = '';

                if((references[1].status === 0)){
                    $('#add-patient').show();
                    $("#message").hide();
                    referencesHtml += "<p class='text-success'>Palatada bemorlar mavjud emas!</p>";
                }

                // Loop through the references and generate HTML
                for (var i = 0; i < references[0].length; i++) {
                    referencesHtml += '<div class="row">';
                    referencesHtml += '<div class="col-8">';
                    referencesHtml += '<p><i class="bi bi-person-fill"></i> F.I.SH: ' + references[0][i].name + '</p>';
                    // referencesHtml += '<p><i class="bi bi-building-add"></i> Kelgan: ' + references[0][i].arrival_date + '</p>';
                    referencesHtml += '<p><i class="bi bi-building-add"></i> Ketish sanasi: ' + references[0][i].departure_date + '</p>';
                    referencesHtml += '<p><i class="bi bi-building-dash"></i> Telefon: ' + references[0][i].phone + '</p>';
                    referencesHtml += '</div>';
                    referencesHtml += '<div class="col-4 text-end">';
                    referencesHtml += '<button class="btn btn-warning mb-3 edit-btn" id="'+ references[0][i].id +'"><i class="bi bi-pencil"></i></button><br>';
                    referencesHtml += '<button class="btn btn-danger remove-user" id="'+references[0][i].id+'"><i class="bi bi-trash"></i></button>';
                    referencesHtml += '</div>';
                    referencesHtml += '</div> <hr>';
                }

                // Display the references in the modal
                $('#modalReferences').html(referencesHtml);

            },
            error: function() {

            }
        });

    });

    function logout() {
        window.location="{{ route('logout_nurse') }}";
    }







</script>
<!-- Template Javascript -->
<script src="{{ asset('js/main.js') }}"></script>
<script src="{{ asset('js/modals.js') }}"></script>
</body>

</html>
