@extends('admin.layouts.inc.app')

@section('content')

    <!-- date -->
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
        <div class="p-2">
            <a href="{{route('admin.purchase.create')}}" class="stoped">
                <i class="fas fa-plus me-2"></i>
                إضافة
            </a>
        </div>
        <div class="d-flex flex-wrap justify-content-end mb-3">
            <div class="p-2">
                <select class="form-select shadow-lg" id="changeFilter">
                    <option value="" disabled selected>إختر</option>
                    <option value="today" {{$request->filter=='today'?'selected':''}}>Today </option>
                    <option value="thisWeek" {{$request->filter=='thisWeek'?'selected':''}}>This week</option>
                    <option value="lastWeek" {{$request->filter=='lastWeek'?'selected':''}}>Last week</option>
                    <option value="lastMonth" {{$request->filter=='lastMonth'?'selected':''}}>Last month</option>
                    <option value="thisMonth" {{$request->filter=='thisMonth'?'selected':''}}>This month</option>
                    <option value="lastYear" {{$request->filter=='lastYear'?'selected':''}}>Last year</option>
                    <option value="thisYear" {{$request->filter=='thisYear'?'selected':''}}>This year</option>
                </select>
            </div>
            <div class="p-2">
                <input type="month" class="form-control" id="choseMonth" value="{{$request->month}}">

            </div>
            <div class="p-2">
                <a href="{{route('admin.export.purchase')}}" class="btn  exportExcel"> <i class="fas fa-download me-2"></i> Export Excel
                </a>
            </div>
        </div>
    </div>
    <!-- drivers -->
    <section class="drivers ">
        <!-- table -->
        <div class="table-responsive mb-0 rounded" data-pattern="priority-columns">
            <table id="datatable" class="table dt-responsive table-striped nowrap">
                <thead>
                <tr>
                    <th> التاريخ </th>
                    <th> الاسم </th>
                    <th> التصنيف </th>
                    <th> القيمة </th>
                    <th> العدد </th>
                    <th> الدفع </th>
                    <th> </th>
                </tr>
                </thead>
                <tbody>
             @foreach($purchases as $purchase)
                <tr id="{{$purchase->id}}">
                    <td> {{$purchase->date}} </td>
                    <td> {{$purchase->name}} </td>
                    <td> {{$purchase->category}}</td>
                    <td>  {{$purchase->value}} </td>
                    <td> {{$purchase->count}} </td>
                    <td>

                    @if($purchase->payment_method=='cash')
كاش
                        @else
                        تحويل بنكي
                        @endif
                    </td>
                    <td>
                        <div class="actionsIcons">
                            <a href="{{route('admin.purchase.edit',$purchase->id)}}" class="edit"> <i
                                    class="fas fa-edit"></i> </a>
                            <a data-id="{{$purchase->id}}" class="delete delete-data"> <i class="fas fa-trash-alt"></i> </a>
                        </div>
                    </td>
                </tr>
             @endforeach
                </tbody>
            </table>

            <nav aria-label="...">
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" href="{{$purchases->previousPageUrl()}}">Previous</a>
                    </li>
                    @for($i=1;$i<=$purchases->lastPage();$i++)
                        <li class="page-item"><a class="page-link" href='?page={{$i}}'> {{$i}}</a></li>
                    @endfor
                    <li class="page-item ">
                        <a class="page-link"  href="{{$purchases->nextPageUrl()}}">Next</a>
                    </li>
                </ul>
            </nav>

        </div>
    </section>

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

    <!-- End drivers -->
    </div>
    </div>


@endsection


@section('js')

   <script>
       $(function(){
           var dtToday = new Date();

           var month = dtToday.getMonth() + 1;
           var day = dtToday.getDate();
           var year = dtToday.getFullYear();
           if(month < 10)
               month = '0' + month.toString();
           if(day < 10)
               day = '0' + day.toString();

           var maxDate = year + '-' + month ;
           $('#choseMonth').attr('max', maxDate);
       });
       $('#changeFilter').on('change',function(){
           var val = $(this).val();
           var myUrl = "{{route('admin.purchase.index')}}?month={{date('Y-m')}}&type=filter&filter="+val
           window.location = myUrl
       });
       $('#choseMonth').on('keyup keydown change', function(){
           var val = $(this).val();
           var myUrl = "{{route('admin.purchase.index')}}?month="+val+"&type=month";
           window.location = myUrl
       });

       $(document).on("click",".delete-data", function (e) {
           e.preventDefault();
           $(function () {
               $('#delete_modal').modal('show');
           });
           var id= $(this).attr('data-id');
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
               url:"{{route('admin.purchase.delete')}}",
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

       @if(session()->has('message'))

       toastr.success('تمت العملية بنجاح');
       @endif

   </script>





@endsection
