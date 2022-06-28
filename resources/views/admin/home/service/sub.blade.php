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
            <div class="singlePackage" id="{{$service->id}}">
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
                            <a  serviceid="{{$service->id}}" class="btn delete delete-data" data-toggle="modal" data-target="#delete_modal" > حذف </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <nav aria-label="...">
            <ul class="pagination">
                <li class="page-item">
                    <a class="page-link" href="{{$subservices->previousPageUrl()}}">Previous</a>
                </li>
                @for($i=1;$i<=$subservices->lastPage();$i++)
                    <li class="page-item"><a class="page-link" href='?page={{$i}}'> {{$i}}</a></li>
                @endfor
                <li class="page-item ">
                    <a class="page-link"  href="{{$subservices->nextPageUrl()}}">Next</a>
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
   // $('#delete_modal').show();
    @if(session()->has('message'))

    toastr.success('تمت العملية بنجاح');
    @endif


    $(document).on("click",".delete-data", function (e) {
        e.preventDefault();
        $(function () {
            $('#delete_modal').modal('show');
        });
        var id= $(this).attr('serviceid');
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
            url:"{{route('deletesubservice')}}",
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
</script>
@endsection
