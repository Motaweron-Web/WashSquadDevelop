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

        <div class="singlePackage" id="{{$period->id}}">
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
                        <a href="" periodid="{{$period->id}}" class="btn delete delete-data"> حذف </a>
                        <a href="{{route('edittime',$period->id)}}" class="btn edit"> تعديل </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- end singlePackage -->
        @endforeach
             <nav aria-label="...">
                 <ul class="pagination">
                     <li class="page-item">
                         <a class="page-link" href="{{$periods->previousPageUrl()}}">Previous</a>
                     </li>
                     @for($i=1;$i<=$periods->lastPage();$i++)
                         <li class="page-item"><a class="page-link" href='?page={{$i}}'> {{$i}}</a></li>
                     @endfor
                     <li class="page-item ">
                         <a class="page-link"  href="{{$periods->nextPageUrl()}}">Next</a>
                     </li>
                 </ul>
             </nav>

             <div class="modal " id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                  aria-hidden="true">
                 <div class="modal-dialog" role="document">
                     <div class="modal-content">
                         <div class="modal-header">
                             <h5 class="modal-title" id="exampleModalLabel">حذف بيانات</h5>
                             <button type="button" class="close toggle-model" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true">×</span>
                             </button>
                         </div>
                         <div class="modal-body">
                             <input id="delete_id" name="id" type="hidden">
                             <p>هل انت متأكد من حذف البيانات التالية <span id="title" class="text-danger"></span>؟</p>
                         </div>
                         <div class="modal-footer">
                             <button type="button" class="close toggle-model btn-primary" data-dismiss="modal" aria-label="Close">
                                 <span >اغلاق</span>
                             </button>
                             <button type="button" class="btn btn-danger" id="delete_btn">حذف !</button>
                         </div>
                     </div>
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



                        </script>
            <script>

                $(document).on("click",".delete-data", function (e) {
                    e.preventDefault();
                    $(function () {
                        $('#delete_modal').modal('show');
                    });
                    var id= $(this).attr('periodid');
                    $('#delete_id').val(id);
                });



                $(document).on("click",".toggle-model", function (e) {
                    e.preventDefault();
                    $(function () {
                        $('#delete_modal').modal('toggle');
                    });
                });


                $(document).on("click","#delete_btn", function (e) {
                    e.preventDefault();
                    var id=$('#delete_id').val();

                    $.ajax({
                        type:'GET',
                        url:"{{route('deletetime')}}",
                        data:{
                            id:id,
                        },

                        success:function(res){
                            if(res['status']==true)
                            {

                                toastr.success('تمت عملية الحذف بنجاح')
                                $(`#${id}`).remove();

                                $(function () {
                                    $('#delete_modal').modal('toggle');
                                });

                            }
                            else if(res['status']==false)
                                location.reload();

                            else
                                location.reload();

                        },
                        error: function(data){
                            location.reload();
                        }
                    });

                });




                {{--$(document).on("click",".deleteperiod", function (e) {--}}
                {{--    e.preventDefault();--}}
                {{--    var id= $(this).attr('periodid');--}}
                {{--    $.ajax({--}}
                {{--        type:'GET',--}}
                {{--        url:"{{route('deletetime')}}",--}}
                {{--        data:{--}}
                {{--            id:id,--}}
                {{--        },--}}

                {{--        success:function(res){--}}
                {{--            if(res['status']==true)--}}
                {{--            {--}}

                {{--                location.reload();--}}

                {{--            }--}}
                {{--            else if(res['status']==false)--}}
                {{--                location.reload();--}}

                {{--            else--}}
                {{--                alert('fff');--}}

                {{--        },--}}
                {{--        error: function(data){--}}
                {{--            alert('error');--}}
                {{--        }--}}
                {{--    });--}}

                {{--});--}}
            </script>

        @endsection

