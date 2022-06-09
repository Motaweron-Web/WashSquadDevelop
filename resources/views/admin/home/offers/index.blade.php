@extends('admin.layouts.inc.app')

@section('content')



    <!-- breadcrumb -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item active"> <a href=""> العروض </a> </li>
        </ol>
        <a href="{{route('createoffer')}}" class="btn mainBtn"> اضافة جديد <i
                class="fas fa-plus-circle ms-2"></i> </a>
    </div>
    <!-- end breadcrumb -->
    <!--packages  -->
    <section class="packages">
        <!-- singlePackage -->
            @foreach($offers as $offer)
        <div class="singlePackage" id="{{$offer->id}}">
            <div class="row">

                <div class="col p-2">
                    <div class="packageData">
                        <h6 class="title"> الصورة </h6>
                        <img src="{{asset(''.$offer->ar_image)}}" width="70" height="70" alt="">
                    </div>
                </div>
                <div class="col p-2">
                    <div class="packageDate">
                        <h6 class="title"> تاريخ الانتهاء </h6>
                        <p> {{date('Y:m:d',$offer->expiredate)}} </p>

                    </div>
                </div>
                <div class="col p-2">
                    <div class="packageData text-start">
                        <h6 class="title"> الباقة المدرجة </h6>
                        <ul>
                            <li>{{$offer->service->ar_title}}</li>
                        </ul>
                    </div>
                </div>

                <div class="col p-2">
                    <div class="actionsIcons">
                        <a href="{{route('editoffer',$offer->id)}}" class="edit"> <i
                                class="fas fa-edit"></i> </a>
                        <a href="#!" offerid="{{$offer->id}}" class="delete deleteoffer"> <i class="fas fa-trash-alt"></i> </a>
                    </div>
                </div>
            </div>
        </div>

        @endforeach


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
        $(document).on("click",".deleteoffer", function (e) {
            e.preventDefault();
            var id= $(this).attr('offerid');
            $.ajax({
                type:'GET',
                url:"{{route('deleteoffer')}}",
                data:{
                    id:id,
                },

                success:function(res){
                    if(res['status']==true)
                    {

                        $(`#${id}`).remove();

                    }
                    else if(res['status']==false)
                        location.reload();


                },
                error: function(data){
                    alert('error');
                }
            });

        });
    </script>
@endsection

