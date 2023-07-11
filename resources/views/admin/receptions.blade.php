@extends('admin.header')

@section('home')
    active
@endsection
@section('section')
    <!-- ADD BLOG MODAL -->
    <div class="modal fade" id="addDoctor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Yangi shifokor qo'shish</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('add_doctor') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="input1" class="form-label">F.I.Sh</label>
                            <input type="text" required name="name" class="form-control" id="input1">
                        </div>
                        <div class="mb-3">
                            <label for="input1" class="form-label">Yo'nalishi</label>
                            <input type="text"  name="profession" class="form-control" id="input2">
                        </div>
                        <div class="mb-3">
                            <label for="input1" class="form-label">Telefon raqami</label>
                            <input type="number" required pattern=".{5,10}"  name="phone" class="form-control" id="input3">
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





    <!-- Add Doctor Start -->
    <div class="container-fluid pt-4 px-4">
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Shifokorlar</h6>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDoctor"><span>+</span> Shifokor qo'shish</button>
            </div>
            <div class="table-responsive">
                <table
                    class="table text-start align-middle table-bordered table-hover mb-0"
                >
                    <thead>
                    <tr class="text-dark">
                        <th scope="col">
                            #
                        </th>
                        <th scope="col">F.I.Sh</th>
                        <th scope="col">Yo'nalishi</th>
                        <th scope="col">Tel raqami</th>
                        <th scope="col">Hisobot</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($receptions as $id => $item)
                        <tr>
                            <td>{{ $id+1 }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->profession }}</td>
                            <td>{{ $item->phone }}</td>
                            <td>Hisobot</td>
                            <td>
                                <a class="btn btn-sm btn-warning" href="">Edit</a>
                            </td>
                            <td>
                                <a class="btn btn-sm btn-danger" href="">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
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
