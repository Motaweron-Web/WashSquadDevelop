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
                        <a href="#!" offerid="{{$offer->id}}" class="delete delete-data"> <i class="fas fa-trash-alt"></i> </a>
                    </div>
                </div>
            </div>
        </div>

        @endforeach



        <nav aria-label="...">
            <ul class="pagination">
                <li class="page-item">
                    <a class="page-link" href="{{$offers->previousPageUrl()}}">Previous</a>
                </li>
                @for($i=1;$i<=$offers->lastPage();$i++)
                    <li class="page-item"><a class="page-link" href='?page={{$i}}'> {{$i}}</a></li>
                @endfor
                <li class="page-item ">
                    <a class="page-link"  href="{{$offers->nextPageUrl()}}">Next</a>
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
    <!--end packages  -->





@endsection


@section('style')



@endsection

@section('js')


    <script>

        @if(session()->has('message'))

        toastr.success('تمت العملية بنجاح');
        @endif



        $(document).on("click",".delete-data", function (e) {
            e.preventDefault();
            $(function () {
                $('#delete_modal').modal('show');
            });
            var id= $(this).attr('offerid');
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
                url:"{{route('deleteoffer')}}",
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

