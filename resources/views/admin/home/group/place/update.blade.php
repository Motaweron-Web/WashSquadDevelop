@extends('admin.layouts.inc.app')

@section('content')

    <!-- breadcrumb -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item"> <a href="{{route('groups.index')}}"> المناطق و الاحياء </a> </li>
            <li class="breadcrumb-item"> <a href="{{route('getregiondetails',$place->group->id)}}"> {{$place->group->name}} </a> </li>
            <li class="breadcrumb-item active"> <a href="#!"> </a> تعديل حي {{$place->ar_name}} </li>
        </ol>
        <button class="btn btn-dark" onclick="history.back()"> عودة </button>
    </div>
    <!-- end breadcrumb -->
    <!-- edit Service -->
    <section class="editService">
        <form action="{{route('updateplace',$place->id)}}" method="post">
            @csrf
            <div class="mb-3">
                <label class="form-label"> اسم الحي باللغة العربية </label>
                <input class="form-control" name="ar_name" value="{{$place->ar_name}}" type="text" >
            </div>
            <div class="mb-3">
                <label class="form-label"> اسم الحي باللغة الانجليزية </label>
                <input class="form-control" name="en_name" value="{{$place->en_name}}" type="text" >
            </div>

            <div class="d-flex align-items-center my-3 ">
                <label class="form-label"> الحد الأدني للطلب </label>
                <div class="number ms-4">
                    <span class="minus">-</span>
                    <input class="count" name="minimum_order" type="text" value="{{$place->minimum_order}}" />
                    <span class="plus">+</span>
                </div>
            </div>
            <div class="d-flex align-items-center my-3 ">
                <label class="form-label"> تكلفة اضافية </label>
                <div class="number ms-4">
                    <span class="minus">-</span>
                    <input class="count" name="maximum_order"  type="text" value="{{$place->maximum_order}}" />
                    <span class="plus">+</span>
                </div>
            </div>

            <div class="row">

                <div class="col-md-12 p-2">
                    <label class="form-label"> طرق الدفع </label>
                        @foreach($payments as $payment)
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" name="payments[]" @foreach($place->payments as $paymented)  @if($paymented->id==$payment->id) checked @endif @endforeach value="{{$payment->id}}" id="{{$payment->id}}">
                        <label class="form-check-label" for="{{$payment->id}}">
                           {{$payment->type}}
                        </label>
                    </div>
                        @endforeach

                </div>
                <div class="col-md-12 p-2">
                    <label class="form-label"> الباقات الرئيسية </label>
                      @foreach($services as $service)
                    <div class="form-check mb-2">
                        <input class="form-check-input" name="services[]" @foreach($place->services as $serviced)  @if($serviced->id==$service->id) checked @endif @endforeach type="checkbox" value="{{$service->id}}" id="{{$service->id}}">
                        <label class="form-check-label" for="{{$service->id}}">
                            {{$service->ar_title}}
                        </label>
                    </div>
                    @endforeach

                </div>



            </div>
            <div class="d-flex align-content-center justify-content-between py-2">
                <div class="d-flex align-items-center ">
                    <label class="form-label m-0"> حالة الحي </label>
                    <div class="form-check form-switch ms-3">
                        <input class="form-check-input" id="wash" type="checkbox" name="status" role="switch" @if($place->status==1) checked @endif>
                    </div>
                </div>

                <button type="submit" class="btn orangeBtn"> حفظ و إغلاق </button>
            </div>
        </form>
    </section>

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
