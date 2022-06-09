@extends('admin.layouts.inc.app')

@section('content')


            <!-- breadcrumb -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <ol class="breadcrumb ">
                    <li class="breadcrumb-item active"> <a href="app_setting_services.html"> الخدمات </a> </li>
                </ol>
                <!-- <button class="btn btn-dark" onclick="history.back()"> عودة </button> -->
            </div>
            <!-- end breadcrumb -->
            <!-- setting Service -->
            <section class="settingService">
                <div class="container">
                    <div class="d-grid">
                        <!-- service -->
                        @foreach($services as $service)
                        <div class="service">
                            <img src="{{asset(''.$service->ar_image)}}" alt="">
                            <div class="service-title">{{$service->ar_title}} </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input editstatus" serviceid="{{$service->id}}" id="wash" type="checkbox" role="switch" @if($service->visability==1) checked @endif>
                                <label class="form-check-label" for="wash" >
                                    <a href="{{route('getsubserviceformainservice',$service->id)}}" class="btn packagesBtn">
                                        <i class="fas fa-tag"></i>
                                        الباقات
                                    </a>
                                    <a href="{{route('editservice',$service->id)}}" class="btn editBtn">
                                        تعديل
                                    </a>

                                </label>
                            </div>

                        </div>
                        @endforeach
                    </div>
                </div>
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

                  $(document).on("click",".editstatus", function (e) {
                      e.preventDefault();

                     var id= $(this).attr('serviceid');

                      $.ajax({
                          type:'GET',
                          url:"{{route('changeservicevisibility')}}",
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
