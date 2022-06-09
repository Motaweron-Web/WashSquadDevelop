@extends('admin.layouts.inc.app')
@section('content')



    <!-- breadcrumb -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item active"> <a href=""> الاشعارات </a>
            </li>
        </ol>
        <a href="{{route('createnotification')}}" class="btn mainBtn"> ارسال جديد <i
                class="fas fa-plus-circle ms-2"></i> </a>
    </div>
    <!-- end breadcrumb -->
    <!--packages  -->
    <section class="packages">
        <!-- singlePackage -->
        @foreach($notifications as $notification)
        <div class="singlePackage" id="{{$notification->id}}">
            <div class="row">
                <div class="col p-2">
                    <div class="packageDate">
                        <h6 class="title"> تاريخ الارسال </h6>
                        <p> {{$notification->sending_date}} </p>
                    </div>
                </div>
                <div class="col p-2">
                    <div class="packageData">
                        <h6 class="title"> المستهدف </h6>
                        <p> {{ $notification->target}}</p>
                    </div>
                </div>
                <div class="col p-2">
                    <div class="packageData text-start">
                        <h6 class="title"> العنوان </h6>
                        <p>     {{$notification->ar_title}} </p>
                    </div>
                </div>
                <div class="col p-2">
                    <div class="packageData text-start">
                        <h6 class="title"> النص </h6>
                        <p> {{$notification->ar_text}} </p>
                    </div>
                </div>
                <div class="col p-2">
                    <div class="actionsIcons">
                        <a href="#!" notificationid="{{$notification->id}}" class="delete deletenotification"> <i class="fas fa-trash-alt"></i> </a>
                    </div>
                </div>
            </div>
        </div>
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
        $(document).on("click",".deletenotification", function (e) {
            e.preventDefault();
            var id= $(this).attr('notificationid');

            $.ajax({
                type:'GET',
                url:"{{route('deletenotification')}}",
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


    <script>
        $(document).on("click",".changecouponstatus", function (e) {
            var id= $(this).attr('couponid');
            $.ajax({
                type:'GET',
                url:"{{route('changecouponstatus')}}",
                data:{
                    id:id,
                },

                success:function(res){
                    if(res['status']==true)
                    {


                    }
                    else if(res['status']==false)
                        location.reload();

                    else
                    {
                        location.reload();
                    }


                },
                error: function(data){
                    alert('error');
                }
            });

        });
    </script>



@endsection
