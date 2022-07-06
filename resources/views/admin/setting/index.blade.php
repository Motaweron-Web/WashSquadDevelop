@extends('admin.layouts.inc.app')

@section('content')



    <!-- breadcrumb -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <a href="{{route('admin.create.admin')}}" class="btn mainBtn"> اضافة جديد <i
                class="fas fa-plus-circle ms-2"></i> </a>

        <button class="btn btn-dark" onclick="history.back()"> عودة </button>

    </div>
    <!-- end breadcrumb -->
    <!-- drivers -->
    <section class="drivers ">
        <!-- table -->
        <div class="table-responsive mb-0 rounded bg-white" data-pattern="priority-columns">
            <table id="datatable" class="table dt-responsive table-striped nowrap">
                <thead>
                <tr>
                    <th> الصورة </th>
                    <th> اسم المستخدم </th>
                    <th> الحالة </th>
                    <th> </th>
                </tr>
                </thead>
                <tbody>
                @foreach($admins as $admin)
                <tr id="{{$admin->id}}">
                    <td>
                        <img src="{{asset(''.$admin->image)}}" alt="">
                    </td>
                    <td> {{$admin->name}} </td>
                    <td >
                        @if($admin->status==1)
                        <span class="active change_status "    data-id="{{$admin->id}}"> مفعل </span>
                        @else
                            <span class="closed change_status"   data-id="{{$admin->id}}-status"> مغلق </span>

                        @endif
                    </td>
                    <td>
                        <div class="actionsIcons">
                            <a href="{{route('admin.edit.admin',$admin->id)}}" class="edit"> <i
                                    class="fas fa-edit"></i> </a>
                            <a href="#!" class="delete delete-data" admin-id="{{$admin->id}}"> <i class="fas fa-trash-alt"></i> </a>
                        </div>
                    </td>
                </tr>
                @endforeach

                </tbody>
            </table>
            {{$admins->links()}}
        </div>

    </section>
    <!-- End drivers -->



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







@endsection


@section('js')


<script>


    $('.change_status').on('click', function(e) {
        var id=$(this).attr('data-id');
        var element=$(this);
        $.ajax({
            type:'GET',
            url:"{{route('admin.status.change')}}",
            data:{
                id:id,
            },

            success:function(res){
                if(res['status']==true)
                {
                    toastr.success('تم التحديث بنجاح');

                    if(res['active']==0)
                    {
                       element.css("background-color", "#CA3C3C");
                       element.text('مغلق')
                    }
                    else
                    {
                        element.css("background-color", "#4F986E");
                       element.text('مفعل')

                    }
                }
                else if(res['status']==false)
                    location.reload();
                else
                    location.reload();

            },
            error: function(data){
                alert('error');
            }
        });

    });

</script>

<script>

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
            url:"{{route('admin.delete.admin')}}",
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


    $(document).on("click",".delete-data", function (e) {
        e.preventDefault();
        $(function () {
            $('#delete_modal').modal('show');
        });
        var id= $(this).attr('admin-id');
        $('#delete_id').val(id);
    });


</script>



@endsection
