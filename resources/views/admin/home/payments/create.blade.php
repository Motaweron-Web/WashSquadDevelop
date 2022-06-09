@extends('admin.layouts.inc.app')
@section('content')

    <!-- breadcrumb -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item"> <a href="{{route('getpaymentmethod')}}"> طرق الدفع </a> </li>
            <li class="breadcrumb-item active"> <a href="#!"> جديد </a> </li>
        </ol>
        <button class="btn btn-dark" onclick="history.back()"> عودة </button>
    </div>
    <!-- end breadcrumb -->
    <!-- edit Service -->
    <section class="editService">
        <form action="{{route('addpayment')}}" method="post" class="p-3">
            @csrf
            <div class="row">
                <div class="col-md-7 p-2">
                    <div class="mb-3">
                        <label class="form-label"> النوع </label>
                        <input class="form-control" name="type" type="text">
                    </div>
                </div>
                <div class="col-md-7 p-2">
                    <div class="mb-3">
                        <label class="form-label"> التكلفة الاضافية </label>
                        <input class="form-control"  name="extracost" type="text">
                    </div>
                </div>


            </div>
            <div class="row">
                <div class="col-md-6 p-2">
                    <label class="form-label"> التوفر و الظهور </label>
                    <div class="form-check mb-2">
                        <input class="form-check-input" name="visability[]" type="checkbox" value="حجوزات التطبيق" id="service1">
                        <label class="form-check-label" for="service1">
                            حجوزات التطبيق
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" name="visability[]" type="checkbox" value="حجوزات المسوقين" id="service2">
                        <label class="form-check-label" for="service2">
                            حجوزات المسوقين
                        </label>
                    </div>

                </div>

            </div>

            <div class="text-end py-2">
                <button type="submit" class="btn orangeBtn"> حفظ و إغلاق </button>
            </div>


        </form>
    </section>
    <!-- end edit Service -->





@endsection
    @section('style')

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

    @section('js')

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

    @endsection

