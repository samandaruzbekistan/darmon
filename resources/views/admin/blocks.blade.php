@extends('admin.header')

@section('blocks')
    active
@endsection
@section('section')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            @foreach($blocks as $item)
                <div class="col-sm-6 col-xl-3">
                    <div
                        class="bg-light rounded d-flex align-items-center justify-content-between p-4"
                    >
                        <h1 class="text-primary">{{ $item->letter }}</h1>
                        <a href="./a-section.html">
                            <div class="ms-3">
                                <p class="mb-2">{{ $item->name }}</p>
                                <h6 class="mb-0">Umumiy palatalar soni: <span>{{ $item->ward_count }}</span></h6>
                                <div class="progress mt-2" role="progressbar" aria-label="Example with label" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar" style="width: {{ $item->filled_prosent }}%">{{ $item->filled_prosent }}%</div>
                                </div>
                            </div>
                        </a>
{{--                        <div class="d-flex gap-1">--}}
{{--                            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editBlog">--}}
{{--                                <i class="bi bi-pencil-fill"></i>--}}
{{--                            </button>--}}
{{--                            </button>--}}
{{--                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addReport">--}}
{{--                                <i class="bi-clipboard"></i>--}}
{{--                            </button>--}}
{{--                        </div>--}}
                    </div>
                </div>
            @endforeach
        </div>
    </div>


    <!-- ADD BLOG MODAL -->
    <div class="modal fade" id="addBlog" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Yangi blog qo'shish</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('add_block') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="input1" class="form-label">Blog harfi</label>
                            <input type="text" required name="block_letter" class="form-control" id="input1">
                        </div>
                        <div class="mb-3">
                            <label for="input1" class="form-label">Blog nomi</label>
                            <input type="text" required name="block_name" class="form-control" id="input1">
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
