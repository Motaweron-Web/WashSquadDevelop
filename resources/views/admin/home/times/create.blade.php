@extends('admin.layouts.inc.app')


@section('content')

    <!-- breadcrumb -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item"> <a href="{{route('showperiods')}}"> الاوقات </a> </li>
            <li class="breadcrumb-item active"> <a href="#!"> </a> إضافة فترة </li>
        </ol>
        <button class="btn btn-dark" onclick="history.back()"> عودة </button>
    </div>
    <!-- end breadcrumb -->
    <!-- edit Service -->
    <section class="editService">
        <form action="{{route('addtime')}}" method="post" >
            @csrf
            <div class="row">
                <div class="col-md-4 p-2">
                    <label class="form-label"> ساعة بداية الفترة </label>
                    <select name="starttime" class="form-select">
                     @for($i=1;$i<=12;$i++)
                            <option value="{{$i}}"> {{$i}}</option>

                        @endfor
                    </select>
                </div>
                <div class="col-md-4 p-2">
                    <label class="form-label"> ساعة نهاية الفترة </label>
                    <select name="endtime" class="form-select">
                        @for($i=1;$i<=12;$i++)
                            <option value="{{$i}}"> {{$i}}</option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-4 p-2">
                    <label class="form-label"> النوع </label>
                    <select name="timetype" class="form-select">
                        <option value="2"> مساءا </option>
                        <option value="1"> صباحا </option>
                    </select>
                </div>
            </div>
            <!-- time orders -->
            <h5 class="p-3 pt-5"> عدد طلبات الفترة </h5>
            <div class="d-flex">
                @foreach($services as $service)
                    @if($service->ar_title=='تلميع')

                        @foreach($sizes as $size)

                            <div class="text-center ">
                                <label class="form-label">{{$service->ar_title}} {{$size->ar_title}} </label>
                                <div class="number ms-4">
                                    <span class="minus">-</span>
                                    <input class="count" name="talmeecount[]" type="text" value="0" />
                                    <span class="plus">+</span>
                                </div>
                            </div>

                        @endforeach
                    @else
                        <div class="text-center ">
                            <label class="form-label">{{$service->ar_title}} </label>
                            <div class="number ms-4">
                                <span class="minus">-</span>
                                <input class="count" name="servicecount[]" type="text" value="0" />
                                <span class="plus">+</span>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            <!-- end time orders -->
            <!-- wait orders -->
            <h5 class="p-3 pt-5"> طلبات الانتظار الفترة </h5>
            <div class="d-flex">
                @foreach($services as $service)
                    @if($service->ar_title=='تلميع')

                        @foreach($sizes as $size)

                            <div class="text-center ">
                                <label class="form-label">{{$service->ar_title}} {{$size->ar_title}} </label>
                                <div class="number ms-4">
                                    <span class="minus">-</span>
                                    <input class="count" name="waittalmeecount[]" type="text" value="0" />
                                    <span class="plus">+</span>
                                </div>
                            </div>

                        @endforeach
                    @else
                        <div class="text-center ">
                            <label class="form-label">{{$service->ar_title}} </label>
                            <div class="number ms-4">
                                <span class="minus">-</span>
                                <input class="count" name="waitservicecount[]" type="text" value="0" />
                                <span class="plus">+</span>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            <!-- end wait orders -->
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

@section('js')

    <!-- JAVASCRIPT -->
    <!-- JAVASCRIPT -->
    <script src="{{asset('assets/libs/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/libs/metismenu/metisMenu.min.js')}}"></script>
    <script src="{{asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
    <script src="{{asset('assets/libs/node-waves/waves.min.js')}}"></script>
    <script src="{{asset('assets/libs/apexcharts/apexcharts.min.js')}}"></script>

    <script src="{{asset('assets/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>

    <script src="{{asset('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/libs/jszip/jszip.min.js')}}"></script>
    <script src="{{asset('assets/libs/pdfmake/build/pdfmake.min.js')}}"></script>
    <script src="{{asset('assets/libs/pdfmake/build/vfs_fonts.js')}}"></script>
    <script src="{{asset('assets/libs/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('assets/libs/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('assets/libs/datatables.net-buttons/js/buttons.colVis.min.js')}}"></script>

    <script src="{{asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>

    <script src="{{asset('assets/libs/dropzone/min/dropzone.min.js')}}"></script>

    <script src="{{asset('assets/js/pages/datatables.init.js')}}"></script>

    <script src="{{asset('assets/libs/jqvmap/jquery.vmap.min.js')}}"></script>
    <script src="{{asset('assets/libs/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
    <script src="{{asset('assets/js/pages/dashboard.init.js')}}"></script>
    <script src="{{asset('assets/js/app.js')}}"></script>


@endsection
