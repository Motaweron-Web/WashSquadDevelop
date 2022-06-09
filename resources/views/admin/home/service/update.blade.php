@extends('admin.layouts.inc.app')

@section('content')


            <!-- breadcrumb -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <ol class="breadcrumb ">
                    <li class="breadcrumb-item"> <a href="{{route('getallservices')}}"> الخدمات </a> </li>
                    <li class="breadcrumb-item active"> <a href="#!"> غسيل </a> </li>
                    <li class="breadcrumb-item active"> <a href="#!"> تعديل </a> </li>
                </ol>
                <button class="btn btn-dark" onclick="history.back()"> عودة </button>
            </div>
            <!-- end breadcrumb -->

            <!-- edit Service -->
            <section class="editService">
                <form action="{{route('updateservice',$service->id)}}" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label"> عنوان الخدمة باللغة العربية </label>
                        <input class="form-control" name="ar_title" value="{{$service->ar_title}}" type="text" placeholder="">
                    </div>
                    <div class="mb-3">
                        <label class="form-label"> عنوان الخدمة باللغة الانجليزية </label>
                        <input class="form-control" type="text" name="en_title" value="{{$service->en_title}}" placeholder="">
                    </div>
                    <div class="row">
                        <div class="col-md-6 p-2">
                            <label class="form-label"> صورة الخدمة عربي </label>

                            <div class="col-md-12 mb-3">
                                <div class="d-flex justify-content-center align-items-center">
                                    <input type="file"  name="ar_image" id="input-file-now-custom-1" class="dropify"
                                           data-default-file="{{asset(''.$service->ar_image)}}" >
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 p-2">
                            <label class="form-label"> صورة الخدمة انجليزي </label>
                            <div class="col-md-12 mb-3">
                                <div class="d-flex justify-content-center align-items-center">
                                    <input type="file"  name="en_image" id="input-file-now-custom-2" class="dropify"
                                           data-default-file="{{asset(''.$service->en_image)}}" >
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="text-end py-2">
                        <button type="submit" class="btn orangeBtn"> حفظ و إغلاق </button>
                    </div>
                </form>
            </section>
            <!-- end edit Service -->





        </div>
    </div>
@endsection

@section('style')



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

