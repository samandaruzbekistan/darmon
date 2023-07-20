@extends('admin.header')

@section('sms')
    active
@endsection
@section('section')
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
                                Xabar yuborildi!
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
                                Xabar yuborilmadi. Balansingizni tekshiring
                            </div>
                        </div>
                    </div>
                </div>
                @break
        @endswitch
    @endif




    <!-- Add Doctor Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">SMS xizmati xodimlar uchun</h6>
                <h6>Balance: <span class="text-danger">{{ $balance }}</span> so'm</h6>
            </div>
            <form action="{{ route('admin_send_sms') }}" method="post">
                @csrf
                <div class="btn-group" role="group">
                    <input type="radio" class="btn-check" name="to" value="doctor" id="btnradio2" autocomplete="off" checked="">
                    <label class="btn btn-outline-primary" for="btnradio2">Shifokorlar</label>

                    <input type="radio" class="btn-check" name="to" value="nurse" id="btnradio3" autocomplete="off">
                    <label class="btn btn-outline-primary" for="btnradio3">Hamshiralar</label>

                    <input type="radio" class="btn-check" name="to" value="employee" id="btnradio4" autocomplete="off">
                    <label class="btn btn-outline-primary" for="btnradio4">Xodimlar</label>
                </div>
                <div class="form-floating mt-3 col-5">
                    <textarea class="form-control" name="message" required placeholder="Leave a comment here" id="floatingTextarea" style="height: 150px;"></textarea>
                    <label for="floatingTextarea">Xabar</label>
                </div>
                <button type="submit" class="btn btn-outline-primary mt-3"><i class="bi bi-chat-dots"></i> Yuborish</button>
            </form>
        </div>
        <!-- Add Doctor End -->
    </div>


    <div class="container-fluid pt-4 px-4 mb-4">
        <div class="bg-light rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">SMS xizmati bemorlar uchun</h6>
                <h6>Balance: <span class="text-danger">{{ $balance }}</span> so'm</h6>
            </div>
            <form action="{{ route('sendSmsToUsers') }}" method="post">
                @csrf
                <div class="row mb-3">
                    <div class="col">
                        <label for="type" class="form-label">Shifokor</label>
                        <select id="block_id" name="doctor" class="form-select" aria-label="Default select example">
                            <option value="all">Barchasi</option>
                            @foreach($doctors as $block)
                                <option value="{{ $block->name }}">{{ $block->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <label for="type" class="form-label">Jinsi</label>
                        <select id="type" name="gender" class="form-select" aria-label="Default select example">
                            <option value="all">Barchasi</option>
                            <option value="male">Erkak</option>
                            <option value="female">Ayol</option>
                        </select>
                    </div>
                    <div class="col">
                        <label for="type" class="form-label">Telefon</label>
                        <select id="type" name="phone" class="form-select" aria-label="Default select example">
                            <option value="phone">O'zinikiga</option>
                            <option value="phone2">Yaqinlarinikiga</option>
                        </select>
                    </div>
                    <div class="col">
                            <label for="leaveDate" class="form-label">Bu sanadan (tug'ilgan sana)</label>
                            <input type="date" max="{{ date('Y-m-d', strtotime('-1 days')) }}" name="start_date" required class="form-control" id="leaveDate">
                    </div>
                    <div class="col">
                            <label for="leaveDate" class="form-label">Bu sanagacha (tug'ilgan sana)</label>
                            <input type="date" max="{{ date('Y-m-d') }}" name="end_date" required class="form-control" id="leaveDate">
                    </div>
                </div>
                <div class="form-floating mt-3 col-5">
                    <textarea class="form-control" name="message" required placeholder="Leave a comment here" id="floatingTextarea" style="height: 150px;"></textarea>
                    <label for="floatingTextarea">Xabar</label>
                </div>
                <button type="submit" class="btn btn-outline-primary mt-3"><i class="bi bi-chat-dots"></i> Yuborish</button>
            </form>
        </div>
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
        $(window).on('load', function() {
            $('#errorModal').modal('show');
        });


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
