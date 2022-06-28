@extends('admin.layouts.inc.app')
@section('content')



    <!-- breadcrumb -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item active"> <a href=""> طرق الدفع
                </a>
            </li>
        </ol>
        <a href="{{route('cretepayment')}}" class="btn mainBtn"> اضافة جديد <i
                class="fas fa-plus-circle ms-2"></i> </a>
    </div>
    <!-- end breadcrumb -->
    <!-- discounts -->
    <section class=" discounts drivers ">
        <!-- table -->
        <div class="table-responsive mb-0 rounded" data-pattern="priority-columns">
            <table id="datatable" class="table dt-responsive table-striped nowrap">
                <thead>
                <tr>
                    <th> النوع </th>
                    <th> تكلفة اضافية </th>
                    <th> التوفر </th>
                    <th> </th>
                </tr>
                </thead>
                <tbody>
                @foreach($payments as $payment)
                <tr id="{{$payment->id}}" class="serv-border">
                    <td> {{$payment->type}} </td>
                    <td> {{$payment->extracost}} </td>
                    <td> {{$payment->visability}} </td>
                    <td>
                        <div class="actionsIcons">
                            <div paymentid="{{$payment->id}}" class="form-check form-switch ms-3 changepaymentstatus">
                                <input class="form-check-input" id="wash"  @if($payment->display==1)  checked @endif type="checkbox" role="switch"
                                       >
                            </div>
                            <a href="{{route('editpayment',$payment->id)}}" class="edit"> <i
                                    class="fas fa-edit"></i> </a>
                            <a  paymentid="{{$payment->id}}" class="delete delete-data"> <i class="fas fa-trash-alt"></i> </a>
                        </div>
                    </td>
                </tr>
                @endforeach

                </tbody>
            </table>
            <nav aria-label="...">
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" href="{{$payments->previousPageUrl()}}">Previous</a>
                    </li>
                    @for($i=1;$i<=$payments->lastPage();$i++)
                        <li class="page-item"><a class="page-link" href='?page={{$i}}'> {{$i}}</a></li>
                    @endfor
                    <li class="page-item ">
                        <a class="page-link"  href="{{$payments->nextPageUrl()}}">Next</a>
                    </li>
                </ul>
            </nav>
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
        {{--$(document).on("click",".deletepayment", function (e) {--}}
        {{--    e.preventDefault();--}}
        {{--    var id= $(this).attr('paymentid');--}}

        {{--    $.ajax({--}}
        {{--        type:'GET',--}}
        {{--        url:"{{route('deletepayment')}}",--}}
        {{--        data:{--}}
        {{--            id:id,--}}
        {{--        },--}}

        {{--        success:function(res){--}}
        {{--            if(res['status']==true)--}}
        {{--            {--}}

        {{--                $(`#${id}`).remove();--}}

        {{--            }--}}
        {{--            else if(res['status']==false)--}}
        {{--                location.reload();--}}


        {{--        },--}}
        {{--        error: function(data){--}}
        {{--            alert('error');--}}
        {{--        }--}}
        {{--    });--}}

        {{--});--}}
    </script>


    <script>
        $(document).on("click",".changepaymentstatus", function (e) {
            var id= $(this).attr('paymentid');
            $.ajax({
                type:'GET',
                url:"{{route('changepaymentstatus')}}",
                data:{
                    id:id,
                },

                success:function(res){
                    if(res['status']==true)
                    {
                 toastr.success('تم تحديث الحالة بنجاح');

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
        @if(session()->has('message'))

        toastr.success('تمت العملية بنجاح');
        @endif




        $(document).on("click",".delete-data", function (e) {
            e.preventDefault();
            $(function () {
                $('#delete_modal').modal('show');
            });
            var id= $(this).attr('paymentid');
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
                url:"{{route('deletepayment')}}",
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
                toastr.error('لا يمكن حذف تلك الوسيلة')
                }
            });

        });























    </script>



@endsection

