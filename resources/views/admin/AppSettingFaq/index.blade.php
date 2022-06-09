@extends('admin.layouts.inc.app')
@section('class')
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
@endsection

@section('content')

            <!-- breadcrumb -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <ol class="breadcrumb ">
                    <li class="breadcrumb-item active"> <a href="{{route('admin.AppSettingFaq')}}"> الأسئلة المتكررة </a> </li>
                </ol>
                <a href="{{route('admin.AppSettingFaq.store')}}" class="btn mainBtn"> اضافة جديد   <i class="fas fa-plus-circle ms-2"></i> </a>
            </div>
            <!-- end breadcrumb -->
            <!--packages  -->
            @include('admin.alerts.success')
            @include('admin.alerts.errors')
            <section class="packages">
                <!-- singlePackage -->
                @isset($AppSettingFaqs)
                    @foreach($AppSettingFaqs as $AppSettingFaq)
                <div class="singlePackage">



                        <div class="row">
                                <div class="col p-2">

                            <div class="packageData text-start">
                                <h6 class="title"> {{$AppSettingFaq->ar_title}}  </h6>
                                <p>{{$AppSettingFaq->ar_content }}</p>
                            </div>
                        </div>
                        <div class="col p-2">
                            <div class="packageData text-start">
                                <h6 class="title">   {{$AppSettingFaq->en_title}}</h6>
                                <p> this site work all days of the week {{$AppSettingFaq->en_content}} </p>
                            </div>
                        </div>
                        <div class="col p-2">
                            <div class="actions flex-row ms-auto">

                                <a href="{{route('admin.AppSettingFaq.edit',$AppSettingFaq->id)}}" class="btn edit"> تعديل </a>
                                <a href="{{route('admin.AppSettingFaq.delete',$AppSettingFaq->id)}}" class="btn delete"> حذف </a>
                            </div>
                        </div>

                    </div>

                </div>
                @endforeach
                @endisset
            </section>



                @endsection
                @section('js')


                    </script>
                    <script src="href="{{asset('assets/libs/jquery/jquery.min.js')}}"></script>
                    <script src="href="{{asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
                    <script src="href="{{asset('assets/libs/metismenu/metisMenu.min.js')}}"></script>
                    <script src="href="{{asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
                    <script src="href="{{asset('assets/libs/node-waves/waves.min.js')}}"></script>
                    <!-- apexcharts js -->
                    <script src="href="{{asset('assets/libs/apexcharts/apexcharts.min.js')}}"></script>
                    <!-- Required datatable js -->
                    <script src="href="{{asset('assets/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
                    <script src="href="{{asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
                    <!-- Buttons examples -->
                    <script src="href="{{asset('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
                    <script src="href="{{asset('assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js')}}"></script>
                    <script src="href="{{asset('assets/libs/jszip/jszip.min.js')}}"></script>
                    <script src="href="{{asset('assets/libs/pdfmake/build/pdfmake.min.js')}}"></script>
                    <script src="href="{{asset('assets/libs/pdfmake/build/vfs_fonts.js')}}"></script>
                    <script src="href="{{asset('assets/libs/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
                    <script src="href="{{asset('assets/libs/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
                    <script src="href="{{asset('assets/libs/datatables.net-buttons/js/buttons.colVis.min.js')}}"></script>
                    <!-- Responsive examples -->
                    <script src="href="{{asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
                    <script src="href="{{asset('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>
                    <!-- dropzone js -->
                    <script src="href="{{asset('assets/libs/dropzone/min/dropzone.min.js')}}"></script>
                    <!-- Datatable init js -->
                    <script src="href="{{asset('assets/js/pages/datatables.init.js')}}"></script>
                    <!-- jquery.vectormap map -->
                    <script src="href="{{asset('assets/libs/jqvmap/jquery.vmap.min.js')}}"></script>
                    <script src="href="{{asset('assets/libs/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
                    <script src="href="{{asset('assets/js/pages/dashboard.init.js')}}"></script>
                    <script src="href="{{asset('assets/js/app.js')}}"></script>
                    <script>
                        $('#MainHeader').load('header.html');
                        $('#MainSidebar').load('sidebar.html');
                    </script>
@endsection

