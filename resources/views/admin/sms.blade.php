@extends('admin.header')

@section('sms')
    active
@endsection
@section('section')

    <!-- Add Doctor Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">SMS xizmati</h6>
                <h6>Balance: <span class="text-danger">{{ $balance }}</span> so'm</h6>
            </div>
            <form action="{{ route('admin_send_sms') }}" method="post">
                @csrf
                <div class="btn-group" role="group">
                    <input type="radio" class="btn-check" name="to" value="patient" id="btnradio1" autocomplete="off">
                    <label class="btn btn-outline-primary" for="btnradio1">Bemorlar</label>

                    <input type="radio" class="btn-check" name="to" value="doctor" id="btnradio2" autocomplete="off" checked="">
                    <label class="btn btn-outline-primary" for="btnradio2">Shifokorlar</label>

                    <input type="radio" class="btn-check" name="to" value="nurse" id="btnradio3" autocomplete="off">
                    <label class="btn btn-outline-primary" for="btnradio3">Hamshiralar</label>

                    <input type="radio" class="btn-check" name="to" value="nurse" id="btnradio4" autocomplete="off">
                    <label class="btn btn-outline-primary" for="btnradio4">Qabulxona</label>
                </div>
                <div class="form-floating mt-3 col-5">
                    <textarea class="form-control" name="message" required placeholder="Leave a comment here" id="floatingTextarea" style="height: 150px;"></textarea>
                    <label for="floatingTextarea">Xabar</label>
                </div>
                <button type="submit" class="btn btn-outline-primary mt-3"><i class="bi bi-chat-dots"></i> Yuborish</button>
            </form>
        </div>
        </d>
        <!-- Add Doctor End -->
    </div>
    <!-- Content End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"
    ><i class="bi bi-arrow-up"></i
        ></a>

@endsection


@section('js')
    <script>
        $(document).on('click', '.btn-edit', function() {
            let id = $(this).attr('id');
            $.ajax({
                url: '{{ route('editReception') }}/' + id, // Replace with your backend route for handling search
                method: 'GET',
                success: function(response) {
                    $('#phone').val(response.phone);
                    $('#name').val(response.name);
                    $('#login').val(response.login);
                    $('#id').val(response.id);
                    $('#edit').modal('show');
                },
                error: function() {

                }
            });
        });
    </script>
@endsection
