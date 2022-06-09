@extends('admin.layouts.inc.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item active"> <a href="{{route('getallservices')}}"> الخدمات
                    لاضافية </a> </li>
        </ol>
        <a href="{{route('createminsubservice')}}" class="btn mainBtn"> اضافة جديد <i
                class="fas fa-plus-circle ms-2"></i> </a>
    </div>
    <!-- end breadcrumb -->
    <!--packages  -->
    <section class="packages">
        @foreach($minsubservices as $service)
        <!-- singlePackage -->
        <div class="singlePackage">
            <div class="row">

                <div class="col p-2">
                    <div class="packageName">
                        <h6 class="title"> اسم الخدمة الاضافية </h6>
                        <p>  {{ $service->ar_title }} </p>
                    </div>
                </div>
                <div class="col p-2">
                    <div class="packagePrice">
                        <h6 class="title"> سعر الخدمة </h6>
                        <p> {{$service->price}} SR </p>
                    </div>
                </div>
                <div class="col p-2">
                    <div class="packageDetails text-start">
                        <h6 class="title"> الباقات المدرجة </h6>
                        <ul>
                            @foreach($service->subservices as $ser)
                            <li> {{$ser->ar_title}}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="col p-2">
                    <div class="actionsIcons">
                        <a href="{{route('editminsubservice',$service->id)}}" class="edit"> <i
                                class="fas fa-edit"></i> </a>
                        <a href="#!" serviceid="{{$service->id}}" class="delete deletesub"> <i class="fas fa-trash-alt"></i> </a>
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

