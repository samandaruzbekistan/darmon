@extends('admin.header')

@section('doctors')
    active
@endsection
@section('section')






    <!-- Add Doctor Start -->
    <div id="royhat" class="container-fluid pt-4 px-4" >
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
                <strong>Muvaffaqiyatli!</strong> Shifokor tizimga qo'shildi.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @elseif(session('result') == 2)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Xatolik!</strong> Yuz aniqlanmadi.
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
                <h6 class="mb-0">Shifokorlar</h6>
                <button class="btn btn-primary" id="btn-add"><span>+</span> Shifokor qo'shish</button>
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
                    @foreach($doctors as $id => $item)
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


    <div class="container-fluid pt-4 px-4 addDoctorContainer" style="display: none" id="forma">

        <div class="bg-light rounded p-4">
            <form action="{{ route('add_doctor') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="nameDoctor" class="form-label">F.I.Sh</label>
                    <input type="text" name="name" class="form-control" id="nameDoctor">
                </div>
                <div class="mb-3">
                    <label for="fieldDoctor" class="form-label">Yo'nalishi</label>
                    <input type="text" name="profession" class="form-control" id="fieldDoctor">
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Telefon raqami</label>
                    <input type="number" class="form-control" id="phoneNumber" name="phone">
                </div>

            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h4>Kamera</h4>
                        <video id="video" width="100%" height="auto" autoplay=""></video>
                        <br>
                        <button id="startbutton" class="btn btn-primary"><i class="bi-camera"></i> Rasmga olish</button>
                        <canvas id="canvas" width="320" height="240" style="display:none;"> </canvas>

                    </div>
                    <div class="col-md-6">
                        <h4>Saqlangan</h4>
                        <img id="photo" alt="The screen capture will appear in this box." src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAASwAAACWCAYAAABkW7XSAAAAAXNSR0IArs4c6QAABGlJREFUeF7t1AEJADAMA8HVv5Oa3GAuHq4KwqVkdvceR4AAgYDAGKxASyISIPAFDJZHIEAgI2CwMlUJSoCAwfIDBAhkBAxWpipBCRAwWH6AAIGMgMHKVCUoAQIGyw8QIJARMFiZqgQlQMBg+QECBDICBitTlaAECBgsP0CAQEbAYGWqEpQAAYPlBwgQyAgYrExVghIgYLD8AAECGQGDlalKUAIEDJYfIEAgI2CwMlUJSoCAwfIDBAhkBAxWpipBCRAwWH6AAIGMgMHKVCUoAQIGyw8QIJARMFiZqgQlQMBg+QECBDICBitTlaAECBgsP0CAQEbAYGWqEpQAAYPlBwgQyAgYrExVghIgYLD8AAECGQGDlalKUAIEDJYfIEAgI2CwMlUJSoCAwfIDBAhkBAxWpipBCRAwWH6AAIGMgMHKVCUoAQIGyw8QIJARMFiZqgQlQMBg+QECBDICBitTlaAECBgsP0CAQEbAYGWqEpQAAYPlBwgQyAgYrExVghIgYLD8AAECGQGDlalKUAIEDJYfIEAgI2CwMlUJSoCAwfIDBAhkBAxWpipBCRAwWH6AAIGMgMHKVCUoAQIGyw8QIJARMFiZqgQlQMBg+QECBDICBitTlaAECBgsP0CAQEbAYGWqEpQAAYPlBwgQyAgYrExVghIgYLD8AAECGQGDlalKUAIEDJYfIEAgI2CwMlUJSoCAwfIDBAhkBAxWpipBCRAwWH6AAIGMgMHKVCUoAQIGyw8QIJARMFiZqgQlQMBg+QECBDICBitTlaAECBgsP0CAQEbAYGWqEpQAAYPlBwgQyAgYrExVghIgYLD8AAECGQGDlalKUAIEDJYfIEAgI2CwMlUJSoCAwfIDBAhkBAxWpipBCRAwWH6AAIGMgMHKVCUoAQIGyw8QIJARMFiZqgQlQMBg+QECBDICBitTlaAECBgsP0CAQEbAYGWqEpQAAYPlBwgQyAgYrExVghIgYLD8AAECGQGDlalKUAIEDJYfIEAgI2CwMlUJSoCAwfIDBAhkBAxWpipBCRAwWH6AAIGMgMHKVCUoAQIGyw8QIJARMFiZqgQlQMBg+QECBDICBitTlaAECBgsP0CAQEbAYGWqEpQAAYPlBwgQyAgYrExVghIgYLD8AAECGQGDlalKUAIEDJYfIEAgI2CwMlUJSoCAwfIDBAhkBAxWpipBCRAwWH6AAIGMgMHKVCUoAQIGyw8QIJARMFiZqgQlQMBg+QECBDICBitTlaAECBgsP0CAQEbAYGWqEpQAAYPlBwgQyAgYrExVghIgYLD8AAECGQGDlalKUAIEDJYfIEAgI2CwMlUJSoCAwfIDBAhkBAxWpipBCRAwWH6AAIGMgMHKVCUoAQIGyw8QIJARMFiZqgQlQMBg+QECBDICBitTlaAECBgsP0CAQEbAYGWqEpQAAYPlBwgQyAgYrExVghIgYLD8AAECGQGDlalKUAIEDJYfIEAgI2CwMlUJSoCAwfIDBAhkBAxWpipBCRB46/vA5AUJNVYAAAAASUVORK5CYII=">
                        <input id="photoInput" name="ImageBase64String" type="hidden" value="" required="">
                        <div class="mt-1">
                            <button id="cancel" class="btn btn-danger me-md-2"><i class="bi bi-trash"></i> Bekor qilish</button>
                            <button type="submit" class="btn btn-success"><i class="bi bi-check2-all"></i> Yuklash</button>
                        </div>
                    </div>
                </div>
            </div>

            </form>
        </div>
    </div>
    <!-- Content End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"
    ><i class="bi bi-arrow-up"></i
        ></a>

@endsection



@section('js')
    <script src="{{ asset('js/Video.js?v=1dQhY1rmL-dAkF7M4TbCVaIIhXOS4lDXoWPF3--RU-o') }}" async></script>
    <script src="https://webrtc.github.io/adapter/adapter-latest.js"></script>
    <script src="{{ asset('js/Video.js') }}"></script>

    <script>
        $(document).ready(function () {
            $("#btn-add").click(function () {
                $("#forma").show();
                $("#royhat").hide();
            });

            $("#cancel").click(function (event) {
                event.preventDefault();

                $("#forma").hide();
                $("#royhat").show();
            });
        });




    </script>
@endsection
