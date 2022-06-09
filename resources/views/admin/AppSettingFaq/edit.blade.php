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
                    <li class="breadcrumb-item"> <a href="{{route('admin.AppSettingFaq')}}"> الأسئلة المتكررة </a> </li>
                    <li class="breadcrumb-item active"> <a href="#!"> جديد </a> </li>
                </ol>
                <button class="btn btn-dark" onclick="history.back()"> عودة </button>
            </div>
            <!-- end breadcrumb -->

            <!-- edit Service -->
            <section class="editService">
                <form action="{{route('admin.AppSettingFaq.update',$AppSettingFaqs->id)}}" method="post">
                    @csrf
                    @include('admin.alerts.success')
                    @include('admin.alerts.errors')
                    <div class="mb-3">
                        <label class="form-label"> السؤال  باللغة العربية </label>
                        <input class="form-control" type="text" value="{{$AppSettingFaqs->ar_title}}" name="ar_title" >
                    </div>
                    <div class="mb-3">
                        <label class="form-label"> الجواب  باللغة العربية </label>
                        <textarea class="form-control" rows="5"name="ar_content">{{$AppSettingFaqs -> ar_content}}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"> السؤال  باللغة الانجليزية </label>
                        <input class="form-control" type="text"value="{{$AppSettingFaqs->en_title}}" name ="en_title"  >
                    </div>
                    <div class="mb-3">
                        <label class="form-label"> الجواب  باللغة الانجليزية </label>
                        <textarea class="form-control" rows="5"name="en_content">{{$AppSettingFaqs -> en_content}}</textarea>
                    </div>


                    <div class="text-end py-2">
                        <button type="submit" class="btn orangeBtn"> حفظ و إغلاق </button>
                    </div>
                </form>
            </section>
            <!-- end edit Service -->



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

