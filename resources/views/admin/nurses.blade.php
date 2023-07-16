@extends('admin.header')

@section('nurse')
    active
@endsection
@section('section')
    <!-- ADD BLOG MODAL -->
    <div class="modal fade" id="addDoctor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Yangi hamshira qo'shish</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('addNurse') }}" method="post">
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
                        <div class="mb-3">
                            <label for="input1" class="form-label">Login</label>
                            <input type="text"  name="login" class="form-control" id="input2">
                        </div>
                        <div class="mb-3">
                            <label for="input1" class="form-label">Parol</label>
                            <input type="password"  name="password" class="form-control" id="input2">
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



    <!-- ADD BLOG MODAL -->
    <div class="modal fade" id="edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Yangi shifokor qo'shish</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('updateNurse') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="input1" class="form-label">F.I.Sh</label>
                            <input type="text" readonly required name="name" class="form-control" id="name">
                        </div>
                        <div class="mb-3">
                            <label for="input1" class="form-label">Telefon raqami</label>
                            <input type="number" required pattern=".{5,10}"  name="phone" class="form-control" id="phone">
                        </div>
                        <div class="mb-3">
                            <label for="input1" class="form-label">Login</label>
                            <input type="text"  name="login" class="form-control" id="login">
                        </div>
                        <input type="hidden" id="id" name="id" value="">
                        <div class="mb-3">
                            <label for="input1" class="form-label">Yangi parol</label>
                            <input type="password" required  name="password" class="form-control" id="password">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bekor qilish</button>
                            <button type="submit" class="btn btn-primary">Yangilash</button>
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
        @elseif(session('result') == 5)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Xatolik!</strong> Loginni boshqa kiriting.
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
                <h6 class="mb-0">Hamshiralar</h6>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDoctor"><span>+</span> Hamshira qo'shish</button>
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
                        <th scope="col">Login</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($nurses as $id => $item)
                        <tr>
                            <td>{{ $id+1 }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->phone }}</td>
                            <td>{{ $item->login }}</td>
                            <td>
                                <button class="btn btn-sm btn-edit btn-warning" id="{{ $item->login }}">Edit</button>
                            </td>
                            <td>
                                <form action="{{ route('deleteReception', ['id' => $item->id]) }}" method="POST">
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


@section('js')
    <script>
        $(document).on('click', '.btn-edit', function() {
            let id = $(this).attr('id');
            $.ajax({
                url: '{{ route('editNurse') }}/' + id, // Replace with your backend route for handling search
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
