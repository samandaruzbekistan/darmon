
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
                <input class="form-control border-0" type="search" placeholder="Search">
            </form>
            <div class="navbar-nav align-items-center ms-auto">
                <div class="nav-item">
                    <a href="{{ route('reception_home') }}" class="nav-link active">
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
                        <h4 id="message" class="text-danger" style="display: none">Palata to'lgan</h4>
                        <button type="button" id="add-patient" class="btn btn-outline-primary"><i class="fa fa-plus me-2"></i>Yangi bemor</button>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="modalReferences">

                    </div>
                </div>
            </div>
        </div>
        @if($errors->any())
            <div class="modal   " id="errorModal" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 id="message" class="text-danger">Xatolik!</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" id="modalReferences">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endif

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
                                    <h4 id="message" class="text-danger">Ogohlantirish!</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body" id="modalReferences">
                                    Bemor tizimga kiritildi. Sms xizmatida muammo bor
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
                                    <h4 id="message" class="text-danger">Xatolik!</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body" id="modalReferences">
                                    Sanalar noto'g'ri kiritilgan
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
        <div class="modal fade" id="addPatient" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Yangi bemor qo'shish</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="createPatientForm" action="{{ route('add-patient') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <div class="d-flex justify-content-between">
                                    <div style="display: inline-block">
                                        <label for="namePatient" class="form-label">F.I.SH</label> <sup class="text-danger">*</sup>
                                    </div>

                                    <div class="form-check form-switch" style="display: inline-block">
                                        <input class="form-check-input" type="checkbox" role="switch" id="is_uzbekistan">
                                        <label class="form-check-label" for="is_uzbekistan">Chel el fuqarosi</label>
                                    </div>
                                </div>

                                <input required name="name" type="text" class="form-control" id="namePatient">
                            </div>
                            <div class="row" id="tyil">
                                <div class="mb-3 col-sm-6">
                                    <label for="phone" class="form-label">Telefon raqami</label> <sup class="text-danger">*</sup>
                                    <input name="phone" required type="number" pattern=".{5,}" class="form-control" id="phone">
                                </div>
                                <div class="mb-3 col-sm-6">
                                    <label for="birthdate1" class="form-label">Yaqinlari telefoni</label> <sup class="text-danger">*</sup>
                                    <input name="phone2" required type="number" class="form-control" id="birthdate1">
                                </div>
                            </div>
                            <div class="row" id="tyil">
                                <div class="mb-3 col-sm-6">
                                    <label for="birthdate" class="form-label">Tug'ilgan sanasi</label> <sup class="text-danger">*</sup>
                                    <input name="birth_date" required type="date" class="form-control" id="birthdate">
                                </div>
                                <div class="mb-3 col-sm-6">
                                    <label for="birthdate" class="form-label">Jinsi</label> <sup class="text-danger">*</sup>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="sex" id="flexRadioDefault1" value="male" checked>
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Erkak
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="sex" value="female" id="flexRadioDefault2" >
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            Ayol
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="regions">
                                <div class="mb-3 col-sm-4">
                                    <label for="region" class="form-label">Viloyat</label> <sup class="text-danger">*</sup>
                                    <select id="region" required class="form-select" name="region_id">
                                        <option disabled selected>Tanlang</option>
                                        @foreach($regions as $region)
                                            <option value="{{ $region->id }}">{{ $region->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col-sm-4">
                                    <label for="district" class="form-label">Tuman</label> <sup class="text-danger">*</sup>
                                    <select id="district" name="district_id" class="form-select">
                                        <option disabled selected>Tanlang</option>
                                    </select>
                                </div>
                                <div class="mb-3 col-sm-4">
                                    <label for="quarter" class="form-label">Mahalla</label> <sup class="text-danger">*</sup>
                                    <select id="quarter" name="quarter_id" class="form-select">
                                        <option disabled selected>Tanlang</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="illness" class="form-label">Kasallik</label>
                               <input name="disease" type="text" class="form-control" value=" ">
                            </div>
                            <input type="hidden" name="ward_id" value="0" id="ward_id"/>
                            <input type="hidden" name="block_id" value="0" id="block_id"/>
                            <div class="row">
                                <div class="mb-3 col-sm-4">
                                    <label for="doctor" class="form-label">Shifokor</label> <sup class="text-danger">*</sup>
                                    <select id="doctor" required name="doctor" class="form-select">
                                        <option disabled selected>Tanlang</option>
                                        @foreach($doctors as $doctor)
                                            <option>{{ $doctor->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col-sm-4">
                                    <label for="arriveDate" class="form-label">Kelish sanasi</label> <sup class="text-danger">*</sup>
                                    <input type="date" min="{{ date('Y-m-d') }}" max="{{ date('Y-m-d', strtotime('+30 days')) }}" name="arrival_date" required class="form-control" id="arriveDate">
                                </div>
                                <div class="mb-3 col-sm-4">
                                    <label for="leaveDate" class="form-label">Ketish sanasi</label> <sup class="text-danger">*</sup>
                                    <input type="date" min="{{ date('Y-m-d') }}" max="{{ date('Y-m-d', strtotime('+30 days')) }}" name="departure_date" required class="form-control" id="leaveDate">
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
            $('#is_uzbekistan').change(function() {
                if(this.checked) {
                    $('#regions').hide();
                    $('#tyil').hide();
                    $('#createPatientForm').attr('action', '{{ route('add-patient-abroad') }}');
                }
                else{
                    $('#regions').show();
                    $('#tyil').show();
                    $('#createPatientForm').attr('action', '{{ route('add-patient') }}');
                }
            });
        });

        function submitBtn() {
            document.getElementById('submit').click();
        }

        $(window).on('load', function() {
            $('#errorModal').modal('show');
        });



         $(document).on('change', '#region', function() {
             let selectedId = $(this).val();
             let firstOption = $('#district option:first');

             $("#district").empty();
             $('#district').append('<option value="" disabled selected>Tanlash...</option>');
             $.ajax({
                 url: '{{ route('reception_get_districts') }}/' + selectedId,
                 method: 'GET',
                 success: function(data) {
                     $("#district").empty();
                     $('#district').append('<option value="" disabled selected>Tanlash...</option>');
                     $.each(data, function(key, value){
                         $('#district').append('<option value="' + value.id+ '">' + value.name + '</option>');
                     });
                 }
             });
         });

         $(document).on('change', '#district', function() {
             let selectedId = $(this).val();
             let firstOption = $('#quarter option:first');

             $("#quarter").empty();
             $('#quarter').append('<option value="" disabled selected>Tanlash...</option>');
             $.ajax({
                 url: '{{ route('reception_get_quarters') }}/' + selectedId,
                 method: 'GET',
                 success: function(data) {
                     $("#quarter").empty();
                     $('#quarter').append('<option value="" disabled selected>Tanlash...</option>');
                     $.each(data, function(key, value){
                         $('#quarter').append('<option value="' + value.id+ '">' + value.name + '</option>');
                     });
                 }
             });
         });

         $(document).on('click', '#add-patient', function() {
             $('#addPatient').modal('show'); // Set the ID as the value of the hidden input in the modal
             $('#showPatients').modal('hide');
         });

         $(document).on('click', ".btn-card", function() {
             $('#showPatients').modal('show');
             let cardID = $(this).attr('id');
             let blockID = $(this).attr('data-action');
             $('#ward_id').val(cardID);
             $('#block_id').val(blockID);
             // Display the loading indicator
             $.ajax({
                 url: '{{ route('reception_get_users') }}/' + cardID, // Replace with your backend route for handling search
                 method: 'GET',
                 success: function(response) {
                     var references = response; // Assign the response directly
                     var referencesHtml = '';
                     if (references[1].status === 2){
                         $('#add-patient').hide();
                         $("#message").show();
                     }
                     else if((references[1].status === 0)){
                         $('#add-patient').show();
                         $("#message").hide();
                         referencesHtml += "<p class='text-success'>Palatada bemorlar mavjud emas!</p>";
                     }
                     else if(references[1].status === 1){
                         $('#add-patient').show();
                         $("#message").hide();
                     }
                     // Loop through the references and generate HTML
                     for (var i = 0; i < references[0].length; i++) {
                         referencesHtml += '<p><i class="bi bi-person-fill"></i> F.I.Sh: ' + references[0][i].name + '</p>';
                         referencesHtml += '<p><i class="bi bi-building-add"></i> Kelgan: ' + references[0][i].arrival_date + '</p>';
                         referencesHtml += '<p><i class="bi bi-building-dash"></i> Telefon: ' + references[0][i].phone + '</p>';
                         // Add more fields as needed
                         referencesHtml += '<hr>';
                     }

                     // Display the references in the modal
                     $('#modalReferences').html(referencesHtml);

                 },
                 error: function() {

                 }
             });

         });

        function logout() {
            window.location="{{ route('logout_reception') }}";
        }







    </script>
    <!-- Template Javascript -->
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/modals.js') }}"></script>
</body>

</html>
