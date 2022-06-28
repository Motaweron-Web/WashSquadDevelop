@extends('admin.layouts.inc.app')

@section('content')

    <div class="d-flex justify-content-end align-items-center mb-4">

        <a href="{{route('createregion')}}" class="btn mainBtn"> اضافة مجموعة <i
                class="fas fa-plus-circle ms-2"></i> </a>
    </div>
    <!-- end breadcrumb -->

    <!-- Regions -->
    <section class="regions ">
        <!-- regions -->
        <div class="allRegions">

            <!-- end single Region -->
            <!-- single Region -->
              @foreach($groups as $group)
            <div class="singleRegion row">
                <div class="col-md-7">
                <h5>{{substr($group->name,0,50)}} </h5>
                </div>
                <div class="col-md-2">
                <a href="{{route('editregion',$group->id)}}" class="edit"> <i
                        class="fas fa-edit"></i> </a>
                </div>
                <div class="col-md-3">
                <a href="{{route('getregiondetails',$group->id)}}"> <i class="fas fa-plus-circle"></i> </a>
                </div>
            </div>
              @endforeach
            <!-- end single Region -->
        </div>
        <!-- end regions -->

        <!-- table -->
        <div class="table-responsive mb-0 rounded" data-pattern="priority-columns">
            <table id="datatable" class="table dt-responsive table-striped nowrap">
                <thead>
                <tr>
                    <th> اسم الحي </th>
                    <th> المجموعة </th>
                    <th> الحد الادنى </th>
                    <th> تكلفة اضافية </th>
                    <th> الدفع </th>
                    <th> الحالة </th>
                    <th> </th>
                </tr>
                </thead>
                <tbody>
                  @foreach($places as $place)
                <tr id="{{$place->id}}" class="serv-border">
                    <td> {{$place->ar_name}} </td>
                    <td> {{$place->group->name}} </td>
                    <td> {{$place->minimum_order}}SR </td>
                    <td> {{$place->maximum_order}} SR </td>
                    <td> @foreach($place->payments as $payment) {{$payment->type}}- @endforeach </td>
                    <td > <span id="stat-{{$place->id}}" placeid="{{$place->id}}" @if( $place->status==1) class="active changestatus" @else class="closed changestatus" @endif > @if( $place->status==1)  مفعل @else  مغلق  @endif </span> </td>
                    <td>
                        <div class="actionsIcons">
                            <a href="{{route('editplace',$place->id)}}"  class="edit "> <i
                                    class="fas fa-edit"></i> </a>
                            <a href="" placeid="{{$place->id}}" class="delete delete-data"> <i class="fas fa-trash-alt"></i> </a>
                        </div>
                    </td>
                </tr>
                  @endforeach
                </tbody>
            </table>
{{--            <nav aria-label="...">--}}
{{--                <ul class="pagination">--}}
{{--                    <li class="page-item">--}}
{{--                        <a class="page-link" href="{{$places->previousPageUrl()}}">Previous</a>--}}
{{--                    </li>--}}
{{--                    @for($i=1;$i<=$places->lastPage();$i++)--}}
{{--                        <li class="page-item"><a class="page-link" href='?page={{$i}}'> {{$i}}</a></li>--}}
{{--                    @endfor--}}
{{--                    <li class="page-item ">--}}
{{--                        <a class="page-link"  href="{{$places->nextPageUrl()}}">Next</a>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            </nav>--}}
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

@endsection


@section('style')


@endsection

@section('js')



    <script>

@if(session()->has('message'))

    toastr.success('تمت العملية بنجاح');
    @endif



        $(document).on("click",".changestatus", function (e) {
           e.preventDefault();
            var id= $(this).attr('placeid');
            $.ajax({
                type:'GET',
                url:"{{route('placechangestatus')}}",
                data:{
                    id:id,
                },

                success:function(res){
                    if(res['status']==true)
                    {
//location.reload();

                        if(res['st']==0){
                            $(`#stat-${id}`).toggleClass("active");
                            $(`#stat-${id}`).toggleClass("closed");
                            $(`#stat-${id}`).text("مغلق");
                        }
                        else{
                            $(`#stat-${id}`).toggleClass("active");
                            $(`#stat-${id}`).toggleClass("closed");
                            $(`#stat-${id}`).text("مفعل");

                        }
                        toastr.success("تم تحديث الحالة بنجاح")
                    }
                    else if(res['status']==false)
                        alert('false');

                    else
                        alert('fff');

                },
                error: function(data){

                }
            });

        });





$(document).on("click",".delete-data", function (e) {
    e.preventDefault();
    $(function () {
        $('#delete_modal').modal('show');
    });
    var id= $(this).attr('placeid');
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
        url:"{{route('deleteplace')}}",
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


