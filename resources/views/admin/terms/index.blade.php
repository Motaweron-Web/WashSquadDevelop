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


    <div class="d-flex justify-content-between align-items-center mb-4">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item active"> <a href="app_setting_terms.html"> الاشعارات </a> </li>
        </ol>
        <!-- <button class="btn btn-dark" onclick="history.back()"> عودة </button> -->
    </div>
    <!-- end breadcrumb -->
    <!-- edit Service -->
    @include('admin.alerts.success')
    @include('admin.alerts.errors')
    <section class="editService">
        <form action="{{route('admin.AppSettingTerms.update',$AppSettingTermss->id)}}" method="post">
            @csrf
            <input type="hidden" name="id" value="{{$AppSettingTermss ->id}}">
            <div class="mb-3">
                <label class="form-label"> الشروط و الاحكام باللغة العربية </label>
                <textarea class="form-control" rows="5" name="ar_content"> {{$AppSettingTermss -> ar_content}} </textarea>
            </div>
            <div class="mb-3">
                <label class="form-label"> الشروط و الاحكام باللغة الانجليزية </label>
                <textarea class="form-control" rows="5" name="en_content"> {{$AppSettingTermss -> en_content}}</textarea>
            </div>
            <div class="text-end py-2">
                <button type="submit" class="btn orangeBtn"> حفظ و إغلاق </button>
            </div>
        </form>
    </section>

                @endsection
                @section('js')

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

