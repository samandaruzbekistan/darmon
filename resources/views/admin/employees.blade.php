@extends('admin.header')

@section('employees')
    active
@endsection
@section('section')
    <!-- ADD BLOG MODAL -->
    <div class="modal fade" id="addDoctor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Yangi xodim qo'shish</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('addEmployee') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="input1" class="form-label">F.I.Sh</label>
                            <input type="text" required name="name" class="form-control" id="input1">
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

        @if(session('result') == 1)
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Muvaffaqiyatli!</strong> Xodim tizimga qo'shildi.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @elseif(session('result') == 6)
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Muvaffaqiyatli!</strong> Xodim tizimdan o'chirildi.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @elseif(session('result') == 3)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Xatolik!</strong> API da nosozlik.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @elseif(session('result') == 4)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Xatolik!</strong> Bunday ismli shifokor mavjud.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Xodimlar</h6>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDoctor"><span>+</span> Xodim qo'shish</button>
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
                        <th scope="col">Tel raqami</th>
                        <th scope="col">Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($employees as $id => $item)
                        <tr>
                            <td>{{ $id+1 }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->phone }}</td>
                            <td>
                                <form action="{{ route('deleteEmployees', ['id' => $item->id]) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                                </form>
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



