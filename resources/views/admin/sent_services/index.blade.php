@extends('admin.layouts.inc.app')
@section('class')
    monthly_subscription-table operation monthly-subscription
@endsection
@section('css')
    @include('admin.layouts.loaders.assets.formLoader')
    <link href="{{url('assets/admin')}}/libs/jqvmap/jqvmap.min.css" rel="stylesheet"/>
    <!-- Plugins css -->
    <link href="{{url('assets/admin')}}/libs/dropzone/min/dropzone.min.css" rel="stylesheet" type="text/css"/>
    <!-- DataTables -->
    <link href="{{url('assets/admin')}}/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet"
          type="text/css"/>
    <link href="{{url('assets/admin')}}/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet"
          type="text/css"/>
    <!-- Responsive datatable examples -->
    <link href="{{url('assets/admin')}}/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css"
          rel="stylesheet"
          type="text/css"/>
    <!-- Plugin css -->
    <style>

    </style>
@endsection


@section('content')

    <div class="row mb-3">


        <div class="col-12 row mb-3">
            <div class="add-button col-sm-6">
                <button class="stoped" data-bs-toggle="modal" data-bs-target="#exampleModalScrollable">
                    موظف جديد
                </button>
            </div>

            <div class="d-flex flex-wrap justify-content-end mb-3">

                <div class=" p-1 p-xl-2">
                    <input type="month" class="form-control" id="choseMonth" value="{{$request->month}}">

                </div>
            </div>
        </div>


        <div class="col-md-12 ">


            <div class="table-rep-plugin">
                <div class="table-responsive mb-0 rounded" data-pattern="priority-columns">
                    <table id="datatable-buttons" class="table dt-responsive nowrap">
                        <thead>
                        <tr>
                            <th> رقم الطلب</th>
                            <th> تاريخ الطلب</th>
                            <th> نوع الخدمة</th>
                            <th> العدد</th>
                            <th>خدمة اضافة</th>
                            <th> اسم المرسل</th>
                            <th> رقم الجوال</th>
                            <th> اسم المرسل اليه</th>
                            <th> رقم الجوال</th>
                            <th> الماركة</th>
                            <th> الإجمالى</th>
                            <th> فاتورة</th>
                            <th></th>


                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                            @php
                                $firstSubServiceTitle = '';
                                $subServiceOrder = App\SubServiceOrder::where('order_id',$order->id)->with('service');
                                if($subServiceOrder->count()){
                                        $firstSubServiceTitle = $subServiceOrder->get()[0]->service->ar_title;
                                }
                            @endphp
                            <tr class="   serv-border  ">
                                <td> {{$order->id}}</td>
                                <td>{{$order->date}}</td>
                                <td>{{$order->service->ar_title??''}}</td>
                                <td>{{$order->number_of_cars}}</td>
                                <td>{{$firstSubServiceTitle}}</td>
                                <td> {{$order->from_user->full_name??''}}</td>
                                <td>{{$order->from_user->phone??''}}</td>
                                <td>{{$order->user->full_name??''}}</td>
                                <td>{{$order->user->phone??''}}</td>
                                <td> {{$order->type->ar_title??''}}</td>
                                <td> {{$order->total_price}}SR</td>
                                <td><a href="#"> <i class="fas fa-file-pdf"></i> </a></td>
                                <td>
                                    <a class="stoped order btn text-white" data-bs-toggle="modal"
                                       data-bs-target="#exampleModalScrollable" style="cursor: pointer;"> إدخال
                                        الطلب </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>


        </div> <!-- end col -->
    </div>
    <!-- end row -->





@endsection
@section('js')
    <script src="{{url('assets/admin')}}/libs/apexcharts/apexcharts.min.js"></script>
    <!-- jquery.vectormap map -->
    <script src="{{url('assets/admin')}}/libs/jqvmap/jquery.vmap.min.js"></script>
    <script src="{{url('assets/admin')}}/libs/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- dropzone js -->
    <script src="{{url('assets/admin')}}/libs/dropzone/min/dropzone.min.js"></script>
    <!-- Required datatable js -->
    <script src="{{url('assets/admin')}}/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{url('assets/admin')}}/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>

    <!-- Responsive examples -->
    <script src="{{url('assets/admin')}}/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{url('assets/admin')}}/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
    <script>
        var a = $("#datatable-buttons").DataTable({
            // lengthChange: !1,
            "order": [[ 5, "Asc" ]],

            language: {
                "sProcessing":   "تحميل",
                "sLengthMenu":   "اظهار _MENU_ سجل",
                "sZeroRecords":  "لا يوجد نتائج للبحث",
                "sInfo":         "اظهار _START_ الى  _END_ من _TOTAL_ سجل",
                "sInfoEmpty":    "معلومات خالية",
                "sInfoFiltered": "معلومات منتقاه",
                "sInfoPostFix":  "",
                "sSearch":       "بحث:",
                "sUrl":          "",
                "oPaginate": {
                    "sFirst":    "الاول",
                    "sPrevious": "السابق",
                    "sNext":     "التالى",
                    "sLast":     "الاخير"
                },
                paginate: {
                    previous: "<i class='mdi mdi-chevron-right'>",
                    next: "<i class='mdi mdi-chevron-left'>"
                }
            },
            drawCallback: function (){
                $(".dataTables_paginate > .pagination").addClass("pagination-rounded")
            },
            buttons: [ "excel",  ]
            // "pdf"
        });
        $('#choseMonth').on('keyup keydown change', function(){
            var val = $(this).val()
            window.location.href = "{{route('sent-services.index')}}" + "?month=" + val
        });
    </script>
@endsection
