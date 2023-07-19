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
                        <a href="#">
                            <div class="ms-3">
                                <p class="mb-2">{{ $item->name }}</p>
                                <h6 class="mb-0">Umumiy palatalar soni: <span>{{ $item->ward_count }}</span></h6>
                                <div class="progress mt-2" role="progressbar" aria-label="Example with label" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar" style="width: {{ $item->filled_prosent }}%">{{ $item->filled_prosent }}%</div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

    </div>

    <div class="container-fluid pt-4 px-4">
        <div class="col-sm-12">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">Malumotlar</h6>
                <table class="table" id="tbl_exporttable_to_xls">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Blog</th>
                        <th scope="col">Post</th>
                        <th scope="col">Palata soni</th>
                        <th scope="col">Joylar soni</th>
                        <th scope="col">Bemorlar soni</th>
                        <th scope="col">Foiz</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($blocks as $id => $item)
                        <tr>
                            <th scope="row">{{ $id+1 }}</th>
                            <td>{{ $item->letter }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->ward_count }}</td>
                            <td>{{ $item->space_count }}</td>
                            <td>{{ $item->users_count }}</td>
                            <td>{{ $item->filled_prosent }}%</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <button onclick="ExportToExcel()" class="btn btn-success mt-3"><i class="fas fa-file-excel"></i> Excel export</button>
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
{{--                <form action="{{ route('getFace') }}" method="post">--}}
{{--                    @csrf--}}
{{--                    <div class="modal-body">--}}
{{--                        <div class="mb-3">--}}
{{--                            <label for="input1" class="form-label">Blog harfi</label>--}}
{{--                            <input type="text" required name="image" class="form-control" id="input1">--}}
{{--                        </div>--}}
{{--                        <div class="modal-footer">--}}
{{--                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bekor qilish</button>--}}
{{--                            <button type="submit" class="btn btn-primary">Saqlash</button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </form>--}}
            </div>
        </div>
    </div>


    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top" data-bs-toggle="modal" data-bs-target="#addBlog"><i class="bi bi-plus"></i></a>

@endsection

@section('js')
    <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
    <script>
        function ExportToExcel(type, fn, dl) {
            var elt = document.getElementById('tbl_exporttable_to_xls');
            var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
            return dl ?
                XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
                XLSX.writeFile(wb, fn || ('bloglar-haqida-malumot.' + (type || 'xlsx')));
        }
    </script>
@endsection
