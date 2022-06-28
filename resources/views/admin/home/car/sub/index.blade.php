@extends('admin.layouts.inc.app')

@section('content')

    <!-- breadcrumb -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item active"> <a href=""> أنواع السيارات </a>
            </li>
        </ol>
        <a href="{{route('createsubtypecar')}}" class="btn mainBtn"> اضافة نوع <i
                class="fas fa-plus-circle ms-2"></i> </a>
    </div>
    <!-- end breadcrumb -->
    <!-- drivers -->
    <section class="drivers ">
        <!-- table -->
        <div class="table-responsive mb-0 rounded" data-pattern="priority-columns">
            <table id="datatable" class="table dt-responsive table-striped nowrap">
                <thead>
                <tr>
                    <th> # </th>
                    <th> الاسم بالعربي </th>
                    <th> الاسم بالانجليزي </th>
                    <th> النوع الرئيسي </th>
                    <th> الحجم </th>
                    <th> </th>
                </tr>
                </thead>
                <tbody>
                @foreach($cartypes as $index=> $car)
                    <tr id="{{$car->id}}" class="serv-border">
                        <td> {{++$index}} </td>
                        <td> {{$car->ar_title}} </td>
                        <td> {{$car->en_title}} </td>
                        <th> {{$car->parent->ar_title??''}} </th>
                        <th> @if($car->size==1) كبير @else متوسط او صغير @endif </th>
                        <td>
                            <div class="actionsIcons">
                                <a href="{{route('editsubcar',$car->id)}}" class="edit"> <i class="fas fa-edit"></i> </a>
                                <a carid="{{$car->id}}" href="" class="delete delete-data"> <i class="fas fa-trash-alt"></i> </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>



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
    <!-- End drivers -->


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
            var id= $(this).attr('carid');
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
                url:"{{route('deletemaincar')}}",
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























        $(document).on("click",".deletecar", function (e) {
            e.preventDefault();
            var id= $(this).attr('carid');
            $.ajax({
                type:'GET',
                url:"{{route('deletemaincar')}}",
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

