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


@endsection

@section('js')


              <script>
                  @if(session()->has('message'))

                  toastr.success('تمت العملية بنجاح');
                  @endif


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
                               toastr.success('تم التحديث بنجاح');
location.reload();

                              }
                              else if(res['status']==false)
                                  toastr.error('رجاء المحاولة لاحقا');

                              else
                                  toastr.error('رجاء المحاولة لاحقا');

                          },
                          error: function(data){
                              toastr.error('رجاء المحاولة لاحقا');
                          }
                      });



                  });

              </script>
@endsection
