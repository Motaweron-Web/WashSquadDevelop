@extends('admin.layouts.inc.app')
@section('class')
    add driver form
@endsection
@section('style')

    <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">
    <!-- jvectormap -->
    <link href="{{asset('assets/libs/jqvmap/jqvmap.min.css')}}" rel="stylesheet"/>
    <!-- DataTables -->
    <link href="{{asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <!-- Responsive datatable examples -->
    <link href="{{asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}"
          rel="stylesheet"
          type="text/css"/>
    <!-- Plugins css -->
    <link href="{{asset('assets/libs/dropzone/min/dropzone.min.css')}}" rel="stylesheet" type="text/css"/>
    <!-- Bootstrap Css -->
    <link href="{{asset('assets/css/bootstrap-rtl.min.css')}}" rel="stylesheet" type="text/css"/>
    <!-- Icons Css -->
    <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css"/>
    <!-- App Css-->
    <link href="{{asset('assets/css/app-rtl.min.css')}}" rel="stylesheet" type="text/css"/>

    <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">
    <!-- jvectormap -->
    <link href="{{asset('assets/libs/jqvmap/jqvmap.min.css')}}" rel="stylesheet"/>
    <!-- DataTables -->
    <link href="{{asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <!-- Responsive datatable examples -->
    <link href="{{asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}"
          rel="stylesheet"
          type="text/css"/>
    <!-- Plugins css -->
    <link href="{{asset('assets/libs/dropzone/min/dropzone.min.css')}}" rel="stylesheet" type="text/css"/>
    <!-- Bootstrap Css -->
    <link href="{{asset('assets/css/bootstrap-rtl.min.css')}}" rel="stylesheet" type="text/css"/>
    <!-- Icons Css -->
    <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css"/>
    <!-- App Css-->
    <link href="{{asset('assets/css/app-rtl.min.css')}}" rel="stylesheet" type="text/css"/>

@endsection

@section('content')

    <!-- breadcrumb -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="{{route('admin.AppSettingDrivers.creat')}}" class="btn mainBtn"> اضافة جديد <i
                class="fas fa-plus-circle ms-2"></i> </a>
    </div>
    <!-- end breadcrumb -->
    <!-- drivers -->
    <section class="drivers ">
        @include('admin.alerts.success')
        @include('admin.alerts.errors')
        <!-- table -->
        <div class="table-responsive mb-0 rounded" data-pattern="priority-columns">
            <table id="datatable" class="table dt-responsive table-striped nowrap">
                <thead>
                <tr>
                    <th> الصورة</th>
                    <th> الكود</th>
                    <th> العمولة</th>
                    <th> الحالة</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @isset($AppSettingDrivers)
                    @foreach($AppSettingDrivers as $AppSettingDriver)
                        <tr class="serv-border">
                            <td><img src="{{asset($AppSettingDriver -> logo)}}"></td>
                            <td> {{$AppSettingDriver->name}} </td>
                            <td> {{$AppSettingDriver->commission}} </td>

                            <td>{{$AppSettingDriver -> is_confirmed == 1?'مفعل':'غير مفعل'}}</td>

                            <td>

                                <div class="actionsIcons">
                                    <a href="#!" class="status" data-bs-toggle="modal"
                                       data-bs-target="#driverStatus"> <i class="fas fa-chart-bar"></i> </a>
                                    <a href="{{route('admin.AppSettingDrivers.edit',$AppSettingDriver->id)}}"
                                       class="edit"> <i class="fas fa-edit"></i> </a>
                                    <a href="{{route('admin.AppSettingDrivers.delete',$AppSettingDriver->id)}}"
                                       class="delete"> <i class="fas fa-trash-alt"></i> </a>
                                </div>
                            </td>
                        </tr>



                        <!-- End drivers -->
                        <!-- Modal -->
                        <div class="modal fade driversModal" id="driverStatus" data-bs-backdrop="static" tabindex="-1"
                             aria-labelledby="driverStatusLabel">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="driverStatusLabel"> 2470 </h5>
                                        <i class="fa fa-times" data-bs-dismiss="modal" aria-label="Close"></i>
                                    </div>
                                    <div class="modal-body">
                                        <form action="">
                                            <div class="row align-items-end mb-2">
                                                <div class=" col col-md-7 p-2">
                                                    <label class="form-label"> الفترة </label>

                                                    {{  $printedDate=$endDate}}

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <input class="form-control" type="date">

                                                        </div>
                                                        <div class="col-md-6">
                                                            <input class="form-control" type="date">

                                                        </div>

                                                    </div>
                                                </div>
                                                <div class=" col col-md-5 p-2">
                                                    <button type="submit" class="btn mainBtn"> عرض</button>
                                                </div>
                                            </div>
                                        </form>
                                        <!-- status Details -->
                                        <div class="statusDetails">
                                            <div class="row justify-content-center">
                                                <!-- Single Status -->
                                                <div class="col-6 col-md-3 p-2">
                                                    <div class="SingleStatus">
                                                        <div class="cion">
                                                            <img src="{{asset('assets/images/status/1.png')}}" alt="">
                                                            <h6> Subscriptions </h6>
                                                            <h3> 20 </h3>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End Single Status -->
                                                <!-- Single Status -->
                                                <div class="col-6 col-md-3 p-2">
                                                    <div class="SingleStatus">
                                                        <div class="cion">
                                                            <img src="{{asset('assets/images/status/2.png')}}" alt="">
                                                            <h6> sterilization </h6>
                                                            <h3> 20 </h3>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End Single Status -->
                                                <!-- Single Status -->
                                                <div class="col-6 col-md-3 p-2">
                                                    <div class="SingleStatus">
                                                        <div class="cion">
                                                            <img src="{{asset('assets/images/status/3.png')}}" alt="">
                                                            <h6> Subscriptions </h6>
                                                            <h3> 227 </h3>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End Single Status -->
                                                <!-- Single Status -->
                                                <div class="col-6 col-md-3 p-2">
                                                    <div class="SingleStatus">
                                                        <div class="cion">
                                                            <img src="{{asset('assets/images/status/4.png')}}" alt="">
                                                            <h6> wash </h6>
                                                            <h3> 23 </h3>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End Single Status -->
                                                <!-- Single Status -->
                                                <div class="col-6 col-md-3 p-2">
                                                    <div class="SingleStatus">
                                                        <div class="cion">
                                                            <img src="{{asset('assets/images/status/5.png')}}" alt="">
                                                            <h6> commission </h6>
                                                            <h3> 950 </h3>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End Single Status -->
                                                <!-- Single Status -->
                                                <div class="col-6 col-md-3 p-2">
                                                    <div class="SingleStatus">
                                                        <div class="cion">
                                                            <img src="{{asset('assets/images/status/6.png')}}" alt="">
                                                            <h6> Total order </h6>
                                                            <h3> 78 </h3>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End Single Status -->
                                            </div>
                                        </div>
                                        <!-- end status Details -->
                                        <!-- driver Rate -->
                                        <div class="driverRate">
                                            <div class="row">
                                                <div class="col-md-6 px-2 py-1">
                                                    <!-- driver status -->
                                                    <div class="driverStatus">
                                                        <div class="row">
                                                            <!-- driver Rate Item -->
                                                            <div class="col-3 p-1">
                                                                <div class="driverRateItem">
                                                                    <img
                                                                        src="{{asset('assets/images/driver_status/card_giftcard_black_24dp.svg')}}"
                                                                        alt="">
                                                                    <h6> Total commission </h6>
                                                                    <h5> 275 </h5>
                                                                </div>
                                                            </div>
                                                            <!-- end driver Rate Item -->
                                                            <!-- driver Rate Item -->
                                                            <div class="col-3 p-1">
                                                                <div class="driverRateItem">
                                                                    <img
                                                                        src="{{asset('assets/images/driver_status/Group 482.svg')}}"
                                                                        alt="">
                                                                    <h6> Total order </h6>
                                                                    <h5> 275 </h5>
                                                                </div>
                                                            </div>
                                                            <!-- end driver Rate Item -->
                                                            <!-- driver Rate Item -->
                                                            <div class="col-3 p-1">
                                                                <div class="driverRateItem">
                                                                    <img
                                                                        src="{{asset('assets/images/driver_status/card_giftcard_black_24dp.svg')}}"
                                                                        alt="">
                                                                    <h6> Total commission </h6>
                                                                    <h5> 275 </h5>
                                                                </div>
                                                            </div>
                                                            <!-- end driver Rate Item -->
                                                            <!-- driver Rate Item -->
                                                            <div class="col-3 p-1">
                                                                <div class="driverRateItem">
                                                                    <img
                                                                        src="{{asset('assets/images/driver_status/Group -1.svg')}}"
                                                                        alt="">
                                                                    <h6> Total order </h6>
                                                                    <h5> 275 </h5>
                                                                </div>
                                                            </div>
                                                            <!-- end driver Rate Item -->
                                                            <div class="col-6 px-1 pt-4">
                                                                <button class="btn export">
                                                                    <i class="fas fa-download me-2"></i>
                                                                    Export Excel
                                                                </button>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <!-- end driver status -->
                                                </div>
                                                <div class="col-md-6 p-2">
                                                    <!--full Rate  -->
                                                    <div class="fullRate">
                                                        <h6> AVERAGE REVIEWS CUSTOMER </h6>
                                                        <ol class="fiveStarRate">
                                                            <!-- five stars -->
                                                            <li>
                                                                <div class="stars">
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                </div>
                                                                <div class="reviews">
                                                                    <div class="bar">
                                                                        <span class="percent"
                                                                              style="width: 60% ;"></span>
                                                                    </div>
                                                                    <p class="total"> 140 </p>
                                                                </div>
                                                            </li>
                                                            <!-- end five stars -->
                                                            <!-- four stars -->
                                                            <li>
                                                                <div class="stars">
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                </div>
                                                                <div class="reviews">
                                                                    <div class="bar">
                                                                        <span class="percent"
                                                                              style="width: 20% ;"></span>
                                                                    </div>
                                                                    <p class="total"> 60 </p>
                                                                </div>
                                                            </li>
                                                            <!-- end four stars -->
                                                            <!-- three stars -->
                                                            <li>
                                                                <div class="stars">
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                </div>
                                                                <div class="reviews">
                                                                    <div class="bar">
                                                                        <span class="percent"
                                                                              style="width: 10% ;"></span>
                                                                    </div>
                                                                    <p class="total"> 30 </p>
                                                                </div>
                                                            </li>
                                                            <!-- end three stars -->
                                                            <!-- two stars -->
                                                            <li>
                                                                <div class="stars">
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                </div>
                                                                <div class="reviews">
                                                                    <div class="bar">
                                                                        <span class="percent"
                                                                              style="width: 7% ;"></span>
                                                                    </div>
                                                                    <p class="total"> 16 </p>
                                                                </div>
                                                            </li>
                                                            <!-- end two stars -->
                                                            <!-- one stars -->
                                                            <li>
                                                                <div class="stars">
                                                                    <i class="fa fa-star"></i>
                                                                </div>
                                                                <div class="reviews">
                                                                    <div class="bar">
                                                                        <span class="percent"
                                                                              style="width: 3% ;"></span>
                                                                    </div>
                                                                    <p class="total"> 6 </p>


                                                                </div>
                                                            </li>
                                                            <!-- end one stars -->
                                                        </ol>
                                                    </div>
                                                    <!-- end full Rate -->
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end driver Rate -->

                                    </div>
                                </div>
                            </div>
                        </div>

            @endforeach
            @endisset


        @endsection
        @section('js')

            <script src="{{asset('assets/libs/jquery/jquery.min.js')}}"></script>
            <script src="{{asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
            <script src="{{asset('assets/libs/metismenu/metisMenu.min.js')}}"></script>
            <script src="{{asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
            <script src="{{asset('assets/libs/node-waves/waves.min.js')}}"></script>
            <!-- apexcharts js -->
            <script src="{{asset('assets/libs/apexcharts/apexcharts.min.js')}}"></script>
            <!-- Required datatable js -->
            <script src="{{asset('assets/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
            <script src="{{asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
            <!-- Buttons examples -->
            <script src="{{asset('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
            <script src="{{asset('assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js')}}"></script>
            <script src="{{asset('assets/libs/jszip/jszip.min.js')}}"></script>
            <script src="{{asset('assets/libs/pdfmake/build/pdfmake.min.js')}}"></script>
            <script src="{{asset('assets/libs/pdfmake/build/vfs_fonts.js')}}"></script>
            <script src="{{asset('assets/libs/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
            <script src="{{asset('assets/libs/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
            <script src="{{asset('assets/libs/datatables.net-buttons/js/buttons.colVis.min.js')}}"></script>
            <!-- Responsive examples -->
            <script src="{{asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
            <script
                src="{{asset('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>
            <!-- dropzone js -->
            <script src="{{asset('assets/libs/dropzone/min/dropzone.min.js')}}"></script>
            <!-- jquery.vectormap map -->
            <script src="{{asset('assets/libs/jqvmap/jquery.vmap.min.js')}}"></script>
            <script src="{{asset('assets/libs/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
            <script src="{{asset('assets/js/app.js')}}"></script>
            <script>
                $("#datatable").DataTable({
                    language: {
                        paginate: {
                            previous: "<i class='mdi mdi-chevron-right'>",
                            next: "<i class='mdi mdi-chevron-left'>"
                        }
                    },
                    drawCallback: function () {
                        $(".dataTables_paginate > .pagination").addClass("pagination-rounded")
                    }
                });

            </script>
@endsection
