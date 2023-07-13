@extends('admin.header')

@section('home')
    active
@endsection
@section('section')
        <!-- Sale & Revenue Start -->
        <div class="container-fluid pt-4 px-4">
            <div class="row g-4">
                <div class="col-sm-6 col-xl-3">
                    <a href="./sections.html">
                        <div
                            class="bg-light rounded d-flex align-items-center justify-content-between p-4"
                        >
                            <i class="fa fa-hospital fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">BO'SH O'RINLAR</p>
                                <h6 class="mb-0">Umumiy bo'sh o'rinlar miqdori: <span>{{ $data['empty_spaces'] }}</span></h6>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <a href="./patients.html">
                        <div
                            class="bg-light rounded d-flex align-items-center justify-content-between p-4"
                        >
                            <i class="fa fa-users fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">BEMORLAR</p>
                                <h6 class="mb-0">Umumiy bemorlar miqdori: <span>{{ $data['users'] }}</span></h6>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <a href="./doctors.html">
                        <div
                            class="bg-light rounded d-flex align-items-center justify-content-between p-4"
                        >
                            <i class="fa fa-user-md fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">SHIFOKORLAR</p>
                                <h6 class="mb-0">Umumiy shifokorlar miqdori: <span>{{ $data['doctors'] }}</span></h6>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <a href="#">
                        <div
                            class="bg-light rounded d-flex align-items-center justify-content-between p-4"
                        >
                            <i class="fas fa-sms fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">SMS xizmati</p>
                                <h6 class="mb-0">Bemorlarga sms jo'natish</h6>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <!-- Sale & Revenue End -->
        <!-- Add Patient Start -->
        <div class="container-fluid pt-4 px-4">
            <div class="bg-light text-center rounded p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">Bemorlar</h6>
                    <button class="btn btn-primary"><span>+</span> Bemor qo'shish</button>
                </div>
                <div class="table-responsive">
                    <table
                        class="table text-start align-middle table-bordered table-hover mb-0"
                    >
                        <thead>
                        <tr class="text-dark">
                            <th scope="col">
                                Bloklar
                            </th>
                            <th scope="col">Date</th>
                            <th scope="col">Invoice</th>
                            <th scope="col">Customer</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><input class="form-check-input" type="checkbox" /></td>
                            <td>01 Jan 2045</td>
                            <td>INV-0123</td>
                            <td>Jhon Doe</td>
                            <td>$123</td>
                            <td>Paid</td>
                            <td>
                                <a class="btn btn-sm btn-primary" href="">Detail</a>
                            </td>
                        </tr>
                        <tr>
                            <td><input class="form-check-input" type="checkbox" /></td>
                            <td>01 Jan 2045</td>
                            <td>INV-0123</td>
                            <td>Jhon Doe</td>
                            <td>$123</td>
                            <td>Paid</td>
                            <td>
                                <a class="btn btn-sm btn-primary" href="">Detail</a>
                            </td>
                        </tr>
                        <tr>
                            <td><input class="form-check-input" type="checkbox" /></td>
                            <td>01 Jan 2045</td>
                            <td>INV-0123</td>
                            <td>Jhon Doe</td>
                            <td>$123</td>
                            <td>Paid</td>
                            <td>
                                <a class="btn btn-sm btn-primary" href="">Detail</a>
                            </td>
                        </tr>
                        <tr>
                            <td><input class="form-check-input" type="checkbox" /></td>
                            <td>01 Jan 2045</td>
                            <td>INV-0123</td>
                            <td>Jhon Doe</td>
                            <td>$123</td>
                            <td>Paid</td>
                            <td>
                                <a class="btn btn-sm btn-primary" href="">Detail</a>
                            </td>
                        </tr>
                        <tr>
                            <td><input class="form-check-input" type="checkbox" /></td>
                            <td>01 Jan 2045</td>
                            <td>INV-0123</td>
                            <td>Jhon Doe</td>
                            <td>$123</td>
                            <td>Paid</td>
                            <td>
                                <a class="btn btn-sm btn-primary" href="">Detail</a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Add Patient End -->

        <!-- Add Doctor Start -->
        <div class="container-fluid pt-4 px-4">
            <div class="bg-light text-center rounded p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">Shifokorlar</h6>
                    <button class="btn btn-primary"><span>+</span> Shifokor qo'shish</button>
                </div>
                <div class="table-responsive">
                    <table
                        class="table text-start align-middle table-bordered table-hover mb-0"
                    >
                        <thead>
                        <tr class="text-dark">
                            <th scope="col">
                                <input class="form-check-input" type="checkbox" />
                            </th>
                            <th scope="col">Date</th>
                            <th scope="col">Invoice</th>
                            <th scope="col">Customer</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><input class="form-check-input" type="checkbox" /></td>
                            <td>01 Jan 2045</td>
                            <td>INV-0123</td>
                            <td>Jhon Doe</td>
                            <td>$123</td>
                            <td>Paid</td>
                            <td>
                                <a class="btn btn-sm btn-primary" href="">Detail</a>
                            </td>
                        </tr>
                        <tr>
                            <td><input class="form-check-input" type="checkbox" /></td>
                            <td>01 Jan 2045</td>
                            <td>INV-0123</td>
                            <td>Jhon Doe</td>
                            <td>$123</td>
                            <td>Paid</td>
                            <td>
                                <a class="btn btn-sm btn-primary" href="">Detail</a>
                            </td>
                        </tr>
                        <tr>
                            <td><input class="form-check-input" type="checkbox" /></td>
                            <td>01 Jan 2045</td>
                            <td>INV-0123</td>
                            <td>Jhon Doe</td>
                            <td>$123</td>
                            <td>Paid</td>
                            <td>
                                <a class="btn btn-sm btn-primary" href="">Detail</a>
                            </td>
                        </tr>
                        <tr>
                            <td><input class="form-check-input" type="checkbox" /></td>
                            <td>01 Jan 2045</td>
                            <td>INV-0123</td>
                            <td>Jhon Doe</td>
                            <td>$123</td>
                            <td>Paid</td>
                            <td>
                                <a class="btn btn-sm btn-primary" href="">Detail</a>
                            </td>
                        </tr>
                        <tr>
                            <td><input class="form-check-input" type="checkbox" /></td>
                            <td>01 Jan 2045</td>
                            <td>INV-0123</td>
                            <td>Jhon Doe</td>
                            <td>$123</td>
                            <td>Paid</td>
                            <td>
                                <a class="btn btn-sm btn-primary" href="">Detail</a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Add Doctor End -->
    </div>
    <!-- Content End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"
    ><i class="bi bi-arrow-up"></i
        ></a>

@endsection
