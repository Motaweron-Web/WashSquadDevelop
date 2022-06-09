@extends('admin.layouts.inc.app')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item active"> <a href=""> الاوقات </a> </li>
        </ol>
        <a href="{{route('createtime')}}" class="btn mainBtn"> اضافة فترة  <i class="fas fa-plus-circle ms-2"></i> </a>
    </div>
    <!-- end breadcrumb -->
    <!--packages  -->
    <section class="packages">
         @foreach($periods as $period)

        <div class="singlePackage">
            <div class="row">
                <div class="col p-2">
                    <div class="packageImg">
                        <h6 class="title"> بداية الفترة</h6>
                        <p>{{ explode("-",$period->period_title)[0] }}</p>
                    </div>
                </div>
                <div class="col p-2">
                    <div class="packageName">
                        <h6 class="title"> نهاية الفترة </h6>
                        <p> {{ explode("-",$period->period_title)[1] }}  </p>
                    </div>
                </div>
                <div class="col p-2">
                    <div class="packagePrice">
                        <h6 class="title"> النوع </h6>
                        <p> {{$period->ar_period_type}} </p>
                    </div>
                </div>

                <div class="col p-2">
                    <div class="more">
                        <h6 class="title"> التلميع </h6>
                        <p> {{($periodlimits->where('period_id',$period->id)->where('type','main')->where('service_id',2)->where('size_id',1)->first()->count ??0)  + ($periodlimits->where('period_id',$period->id)->where('type','main')->where('service_id',2)->where('size_id',2)->first()->count ??0) }} </p>
                    </div>
                </div>
                <div class="col p-2">
                    <div class="more">
                        <h6 class="title"> الغسيل </h6>
                        <p> {{$periodlimits->where('period_id',$period->id)->where('type','main')->where('service_id',1)->first()->count  }} </p>
                    </div>
                </div>
                <div class="col p-2">
                    <div class="more">
                        <h6 class="title"> التعقيم </h6>
                        <p> {{$periodlimits->where('period_id',$period->id)->where('type','main')->where('service_id',78)->first()->count  }} </p>
                    </div>
                </div>
                <div class="col p-2">
                    <div class="more">
                        <h6 class="title"> الانتظار </h6>
                        <p> تلميع {{($periodlimits->where('period_id',$period->id)->where('type','wait')->where('service_id',2)->where('size_id',1)->first()->count ??0)  + ($periodlimits->where('period_id',$period->id)->where('type','wait')->where('service_id',2)->where('size_id',2)->first()->count ??0) }}  - غسيل {{$periodlimits->where('period_id',$period->id)->where('type','wait')->where('service_id',1)->first()->count  }} -تعقيم {{$periodlimits->where('period_id',$period->id)->where('type','wait')->where('service_id',78)->first()->count  }}  </p>
                    </div>
                </div>
                <div class="col p-2">
                    <div class="actions flex-row">
                        <a href="" periodid="{{$period->id}}" class="btn delete deleteperiod"> حذف </a>
                        <a href="{{route('edittime',$period->id)}}" class="btn edit"> تعديل </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- end singlePackage -->
        @endforeach
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

            <script>
                $(document).on("click",".deleteperiod", function (e) {
                    e.preventDefault();
                    var id= $(this).attr('periodid');
                    $.ajax({
                        type:'GET',
                        url:"{{route('deletetime')}}",
                        data:{
                            id:id,
                        },

                        success:function(res){
                            if(res['status']==true)
                            {

                                location.reload();

                            }
                            else if(res['status']==false)
                                location.reload();

                            else
                                alert('fff');

                        },
                        error: function(data){
                            alert('error');
                        }
                    });

                });
            </script>

        @endsection

