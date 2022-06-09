@extends('admin.layouts.inc.app')

@section('content')

    <!-- breadcrumb -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item"> <a href="{{route('getallservices')}}"> الخدمات </a> </li>
            <li class="breadcrumb-item active"> <a href="#!"> الباقات </a> </li>
        </ol>
        <a href="{{route('createsubservice',$service->id)}}" class="btn mainBtn"> اضافة باقة <i class="fas fa-plus-circle ms-2"></i> </a>
    </div>
    <!-- end breadcrumb -->
    <!--packages  -->
    <section class="packages">
        <!-- singlePackage -->
        @foreach($subservices as $service)
            <div class="singlePackage">
                <div class="row">
                    <div class="col p-2">
                        <div class="packageImg">
                            <h6 class="title"> صورة الباقة </h6>
                            <img src="{{asset(''.$service->ar_image)}}" alt="">
                        </div>
                    </div>
                    <div class="col p-2">
                        <div class="packageName">
                            <h6 class="title"> اسم الباقة</h6>
                            <p>{{$service->ar_title}} </p>
                        </div>
                    </div>

                    <div class="col p-2">
                        <div class="packageDetails">
                            <h6 class="title"> تفاصيل الباقة </h6>
                            <p> {!!   Str::limit($service->ar_des, 80) !!} </p>

                        </div>
                    </div>
                    <div class="col p-2">
                        <div class="more">
                            <h6 class="title"> الخدمات الاضافية </h6>
                            @foreach($service->subsubservices as $ser)
                            <p>{{$ser->ar_title}}</p>
                            @endforeach
                        </div>
                    </div>
                    <div class="col p-2">
                        <div class="time">
                            <h6 class="title"> وقت الخدمة </h6>
                            <p> {{date('H:i:s',$service->timer)}} </p>
                        </div>
                    </div>
                    <div class="col p-2">
                        <div class="actions">
                            <a href="{{route('editsubservice',$service->id)}}" class="btn edit"> تعديل </a>
                            <a href="" serviceid="{{$service->id}}" class="btn delete deletesub"> حذف </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <!-- end singlePackage -->
        <!-- singlePackage -->

        <!-- end singlePackage -->
    </section>
    <!--end packages  -->

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
<script>
    $(document).on("click",".deletesub", function (e) {
        e.preventDefault();
            var id= $(this).attr('serviceid');
        $.ajax({
            type:'GET',
            url:"{{route('deletesubservice')}}",
            data:{
                id:id,
            },

            success:function(res){
                if(res['status']==true)
                {

                    location.reload();

                }
                else if(res['status']==false)
                    alert('false');

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
