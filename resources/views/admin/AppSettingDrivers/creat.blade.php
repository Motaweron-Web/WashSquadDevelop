@extends('admin.layouts.inc.app')
@section('class')
orders-table operation
@endsection
@section('style')
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">
    <!-- jvectormap -->
    <link href="{{asset('assets/libs/jqvmap/jqvmap.min.css')}}" rel="stylesheet" />
    <!-- DataTables -->
    <link href="{{asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet"
          type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="{{asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" rel="stylesheet"
          type="text/css" />
    <!-- Plugins css -->
    <link href="{{asset('assets/libs/dropzone/min/dropzone.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Bootstrap Css -->
    <link href="{{asset('assets/css/bootstrap-rtl.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{asset('assets/css/app-rtl.min.css')}}" rel="stylesheet" type="text/css" />

<!-- dropify -->
<link rel="stylesheet" href="{{asset('assets/css/dropify.min.css')}}">
<!-- img gallery -->
<link rel="stylesheet" href="{{asset('assets/css/jquery.fancybox.min.css')}}">
<!-- Custom style  -->
<link rel="stylesheet" id="StyleLink" href="{{asset('assets/css/style.css')}}">
<!-- responsive style  -->
<link rel="stylesheet" href="{{asset('assets/css/responsive.css')}}">


<!-- App favicon -->
<link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">
<!-- jvectormap -->
<link href="{{asset('assets/libs/jqvmap/jqvmap.min.css')}}" rel="stylesheet" />
<!-- Bootstrap Css -->
<link href="{{asset('assets/css/bootstrap-rtl.min.css')}}" rel="stylesheet" type="text/css" />
<!-- Plugins css -->
<link href="{{asset('assets/libs/dropzone/min/dropzone.min.css')}}" rel="stylesheet" type="text/css" />
<!-- Icons Css -->
<link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
<!-- App Css-->
<link href="{{asset('assets/css/app-rtl.min.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')


            <!-- breadcrumb -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <ol class="breadcrumb ">
                    <li class="breadcrumb-item"> <a href="{{route('admin.AppSettingDrivers')}}"> السائقين </a> </li>
                    <li class="breadcrumb-item active"> <a href="#!"> جديد </a> </li>
                </ol>
                <button class="btn btn-dark" onclick="history.back()"> عودة </button>
            </div>
            <!-- end breadcrumb -->
            @include('admin.alerts.success')
            @include('admin.alerts.errors')
            <!-- edit Service -->
            <section class="editService">
                <form action="{{route('admin.AppSettingDrivers.store')}}" method="post" inlist="" enctype="multipart/form-data">
@csrf
                    <div class="row">
                        <div class="col-md-6 p-2">
                            <div class="mb-4">
                                <label class="form-label"> كود السائق </label>
                                <input class="form-control" type="number" name="name">
                            </div>
                            <div class="mb-4">
                                <label class="form-label"> نسبة العمولة لكل طلب </label>
                                <input class="form-control" type="number" name="commission">
                            </div>
                            <div class="mb-4">
                                <label class="form-label"> اسم المستخدم </label>
                                <input class="form-control" type="text" name="full_name">
                            </div>
                            <div class="mb-4">
                                <label class="form-label"> اسم السائق </label>
                                <input class="form-control" type="text" name="driver_name">
                            </div>
                            <div class="mb-4">
                                <label class="form-label"> رقم الجوال </label>
                                <input class="form-control" type="number"name="phone">
                            </div>

                        </div>

                        <!--##############################dropeyfy###############################-->
                        <div class="col-md-6 p-2">
                            <label class="form-label"> الصورة </label>
                            <div class="col-md-12 mb-3">
                                <div class="d-flex justify-content-center align-items-center">
                                    <input type="file"  name="logo" id="input-file-now-custom-2" class="dropify"
                                           data-default-file="" >
                                </div>
                            </div>

                        </div>

                            <!--##############################end dropeyfy###############################-->

                            <div class="mb-3">
                                <label class="form-label"> كلمة المرور </label>
                                <input class="form-control" type="password" name="password">
                            </div>
                            <div class="mb-3">
                                <label class="form-label"> اسم العامل </label>
                                <input class="form-control" type="number" name="worker_name">
                            </div>


                        </div>


                    </div>
                    <div class="d-flex align-content-center justify-content-between py-2">
                        <div class="d-flex align-items-center ">
                            <label class="form-label m-0"> تفعيل الحساب </label>
                            <div class="form-check form-switch ms-3">
                                <input class="form-check-input" name="is_confirmed" value="1"  id="wash" type="checkbox" role="switch" checked >
                            </div>
                        </div>

                        <button type="submit" class="btn orangeBtn"> حفظ و إغلاق </button>
                    </div>
                </form>
            </section>
            <!-- end edit Service -->

        </div>
    </div>







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
    <script src="{{asset('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>
    <!-- dropzone js -->
    <script src="{{asset('assets/libs/dropzone/min/dropzone.min.js')}}"></script>
    <!-- Datatable init js -->
    <script src="{{asset('assets/js/pages/datatables.init.js')}}"></script>
    <!-- jquery.vectormap map -->
    <script src="{{asset('assets/libs/jqvmap/jquery.vmap.min.js')}}"></script>
    <script src="{{asset('assets/libs/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
    <script src="{{asset('assets/js/pages/dashboard.init.js')}}"></script>
    <script src="{{asset('assets/js/app.js')}}"></script>
    <script>
        $('#MainHeader').load('header.html');
        $('#MainSidebar').load('sidebar.html');
    </script>


    <!-- JAVASCRIPT -->
    <script src="{{asset('assets/libs/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/libs/metismenu/metisMenu.min.js')}}"></script>
    <script src="{{asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
    <script src="{{asset('assets/libs/node-waves/waves.min.js')}}"></script>
    <!-- dropzone js -->
    <script src="{{asset('assets/libs/dropzone/min/dropzone.min.js')}}"></script>
    <!-- apexcharts js -->
    <script src="{{asset('assets/libs/apexcharts/apexcharts.min.js')}}"></script>
    <!-- jquery.vectormap map -->
    <script src="{{asset('assets/libs/jqvmap/jquery.vmap.min.js')}}"></script>
    <script src="{{asset('assets/libs/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
    <script src="{{asset('assets/js/pages/dashboard.init.js')}}"></script>
    <script src="{{asset('assets/js/app.js')}}"></script>
    <script src="{{asset('assets/js/jquery-3.5.1.min.js')}}"></script>
    <script src="{{asset('assets/js/popper.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.appear.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/mdb.min.js')}}"></script>
    <script src="{{asset('assets/js/swiper.js')}}"></script>
    <script src="{{asset('assets/js/wow.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.fancybox.min.js')}}"></script>
    <script src="{{asset('assets/js/fontawesome-pro.js')}}"></script>
    <script src="{{asset('assets/js/odometer.min.js')}}"></script>
    <script src="{{asset('assets/js/select2.js')}}"></script>
    <script src="{{asset('assets/js/ma5-menu.min.js')}}"></script>
    <script src="{{asset('assets/js/dropify.min.js')}}"></script>
    <script src="{{asset('assets/js/Custom.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ajaxy/1.6.1/scripts/jquery.ajaxy.min.js"></script>
    @endsection

