@extends('admin.header')

@section('wards')
    active
@endsection
@section('section')
    <div class="container-fluid pt-4 px-4">
        @if((session()->has('backData')) and (session('backData') == 1))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Muvaffaqiyatli!</strong> Yangi palata tizimga kiritildi.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
            <div class="row mb-3">
                <div class="col">
                    <select id="block_id" name="block_id" class="form-select" aria-label="Default select example">
                        <option value="all">Barcha blocklar</option>
                        @foreach($blocks as $block)
                            <option value="{{ $block->id }}">{{ $block->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <select id="type" name="type" class="form-select" aria-label="Default select example">
                        <option value="all">Xona turi: Barcha</option>
                        <option value="standard">Standart</option>
                        <option value="pollux">Pol lux</option>
                        <option value="lux">Lux</option>
                    </select>
                </div>
                <div class="col">
                    <select id="status" name="status" class="form-select" aria-label="Default select example">
                        <option value="all">Xona holati: Barcha</option>
                        <option value="2">To'liq</option>
                        <option value="1">Chala to'lgan</option>
                        <option value="0">Bo'sh</option>
                    </select>
                </div>
                <div class="col">
                    <button type="button" id="tugma" class="btn btn-primary">Qo'llash</button>
                </div>
            </div>

        <div class="row g-4" id="wards">
            @if(count($wards) > 0)
                @foreach($wards as $item)
                <div class="col-sm-6 col-xl-3" style="cursor: pointer">
                    <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                        <h1 class="text-primary">{{ $item->number }}</h1>
                        <div class="ms-3">
                            <p class="mb-2">Palata</p>
                            <h6 class="mb-0">Bemorlar soni: <span>{{ $item->users_count }}</span></h6>
                            <div class="progress mt-2" role="progressbar" aria-label="Example with label" aria-valuenow="{{ $item->users_count*100/$item->space_count }}" aria-valuemin="0" aria-valuemax="100">
                                <div class="progress-bar" style="width: {{ $item->users_count*100/$item->space_count }}%">{{ $item->users_count*100/$item->space_count }}%</div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            @else
                <h4 class="text-center mt-5">Palatalar mavjud emas!</h4>
            @endif
        </div>
    </div>


    <!-- ADD BLOG MODAL -->
    <div class="modal fade" id="addBlog" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Yangi palata qo'shish</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('add_ward') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="input1" class="form-label">Palata raqami</label>
                            <input type="number" required name="number" class="form-control" id="input1">
                        </div>
                        <div class="mb-3">
                            <label for="input1" class="form-label">Joylar soni</label>
                            <input type="number" required name="space_count" class="form-control" id="input1">
                        </div>
                        <div class="mb-3">
                            <label for="input1" class="form-label">Palata turi </label>
                            <select id="type" name="type" class="form-select" aria-label="Default select example">
                                <option value="standard">Standard</option>
                                <option value="pollux">Pol lux</option>
                                <option value="lux">Lux</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="input1" class="form-label">Blog </label>
                            <select id="block_id" name="block_id" class="form-select" aria-label="Default select example">
                                @foreach($blocks as $block)
                                    <option value="{{ $block->id }}">{{ $block->letter }} blok {{ $block->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bekor qilish</button>
                            <button type="submit" class="btn btn-primary">Saqlash</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- EDIT BLOG MODAL -->
    {{--    <div class="modal fade" id="editBlog" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">--}}
    {{--        <div class="modal-dialog">--}}
    {{--            <div class="modal-content">--}}
    {{--                <div class="modal-header">--}}
    {{--                    <h5 class="modal-title" id="exampleModalLabel">Blog ma'lumotlarini tahrirlash</h5>--}}
    {{--                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>--}}
    {{--                </div>--}}
    {{--                <div class="modal-body">--}}
    {{--                    <div class="mb-3">--}}
    {{--                        <label for="input1" class="form-label">Blog nomi</label>--}}
    {{--                        <input type="text" class="form-control" id="input1">--}}
    {{--                    </div>--}}
    {{--                    <div class="mb-3">--}}
    {{--                        <label for="input3" class="form-label">Umumiy palatalar soni</label>--}}
    {{--                        <input type="number" class="form-control" id="input3">--}}
    {{--                    </div>--}}
    {{--                    <div class="modal-footer">--}}
    {{--                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bekor qilish</button>--}}
    {{--                        <button type="button" class="btn btn-primary">Saqlash</button>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}

    {{--    <!-- ADD REPORT MODAL -->--}}
    {{--    <div class="modal fade" id="addReport" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">--}}
    {{--        <div class="modal-dialog">--}}
    {{--            <div class="modal-content">--}}
    {{--                <div class="modal-header">--}}
    {{--                    <h5 class="modal-title" id="exampleModalLabel">Hisobot kiritish</h5>--}}
    {{--                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>--}}
    {{--                </div>--}}
    {{--                <div class="modal-body">--}}
    {{--                    <div class="mb-3">--}}
    {{--                        <label for="input1" class="form-label">Palata nomi</label>--}}
    {{--                        <input type="text" class="form-control" id="input1">--}}
    {{--                    </div>--}}
    {{--                    <div class="mb-3">--}}
    {{--                        <label for="input2" class="form-label">Shifokor ism-familiyasi</label>--}}
    {{--                        <select name="selectDoctor" id="input2" class="form-select">--}}
    {{--                            <option value="">Doktor Haus</option>--}}
    {{--                            <option value="">Doktor Jamshid</option>--}}
    {{--                            <option value="">Doktor Doniyor</option>--}}
    {{--                        </select>--}}
    {{--                    </div>--}}
    {{--                    <div class="mb-3">--}}
    {{--                        <label for="input3" class="form-label">Hisobot</label>--}}
    {{--                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>--}}
    {{--                    </div>--}}
    {{--                    <div class="modal-footer">--}}
    {{--                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bekor qilish</button>--}}
    {{--                        <button type="button" class="btn btn-primary">Saqlash</button>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}
    {{--    <!-- Content End -->--}}


    <!-- Back to Top -->
    <!-- <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a> -->

    <!-- Add new blog button -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top" data-bs-toggle="modal" data-bs-target="#addBlog"><i class="bi bi-plus"></i></a>

@endsection


@section('js')
    <script>
        $(document).ready(function() {
            $('#tugma').on('click', function () {
                let block_id = $('#block_id').val();
                let type = $('#type').val();
                let status = $('#status').val();

                $.ajax({
                    url: '{{ route('admin_wards_with_params') }}',
                    type: 'GET',
                    data: {block_id: block_id, type:type, status:status},
                    success: function (response) {
                        let wardsContainer = $('#wards');
                        wardsContainer.empty();
console.log(response)
                        $.each(response, function(key, item) {
                            let wardItem = `
                  <div class="col-sm-6 col-xl-3">
                     <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                        <h1 class="text-primary"> ${item.number}</h1>
                        <a href="./a-section.html">
                           <div class="ms-3">
                              <p class="mb-2">Palata</p>
                              <h6 class="mb-0">Bemorlar soni: <span> ${item.users_count}</span></h6>
                              <div class="progress mt-2" role="progressbar" aria-label="Example with label" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                 <div class="progress-bar" style="width: ${item.users_count*100/item.space_count}%">${item.users_count*100/item.space_count}%</div>
                              </div>
                           </div>
                        </a>
                     </div>
                  </div>
               `;
                            wardsContainer.append(wardItem);
                        });
                    },
                    error: function (xhr, status, error) {
                        console.log(error);
                    }
                });
            });
        });
    </script>

@endsection
