@extends('admin.layouts.inc.app')
@section('class')
@endsection
@section('style')
    <style>
    #modal-content {

    position: relative !important;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex !important;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -ms-flex-direction: column;
    flex-direction: column;
    width: 100%;
    pointer-events: auto;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #f1f5f7;
    border-radius: 0.4rem;
    outline: 0;
    }
    #modal-footer{
    position: absolute;
    bottom: -15%;
    }
    .x{
        width: 285px;
    }
    </style>
@endsection

@section('content')

    <div class="container-fluid">
        <!-- date -->
        @include('admin.alerts.success')
        @include('admin.alerts.errors')

        <div class="d-flex flex-wrap justify-content-end mb-3">
            <form id="searchForm" action="{{route('admin.SalariesCommissions.search',':search')}}" >
            <div class="p-2 col-4 x">
                <input type="search" id="searchInput" class="form-control" placeholder=" اسم الموظف " name="name">
            </div></form>
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
                <a href="{{route('admin.SalariesCommissions.excel')}}"class="form-control" id="downloadExcel" type="button"> <i class="fas fa-download me-2"></i> Export Excel
               </a>
{{--            </div>--}}
{{--            <div class=" p-1 p-xl-2 col-md-6">--}}
{{--                <button id="downloadExcel" class="form-control" type="button">EXport To EXcel</button>--}}
{{--            </div>--}}

        </div>
        <!-- tables -->
        <div class="burn">

            <div class="table-responsive mb-0 rounded">
                <table id="datatable" class="table  bg-white dt-responsive nowrap" >
                    <thead>
                    <tr>
                        <th> التاريخ </th>
                        <th> إسم الموظف </th>
                        <th> الراتب الشهري </th>
                        <th> الخصومات </th>
                        <th> السلفة </th>
                        <th> الغياب </th>
                        <th> العمولة </th>
                        <th> الإجمالي </th>
                        <th> تم تحويل الراتب </th>
                        <th> إرفاق الفاتورة </th>
                        <th> </th>
                    </tr>
                    </thead>
                    <tbody>
                    @isset($SalaryAndcommissions)
                        @foreach($SalaryAndcommissions as $SalaryAndcommission)
                    <tr>

                        <td> {{$SalaryAndcommission->commencement_date}} </td>
                        <td>  {{$SalaryAndcommission->name}} </td>

                        <td> <input class="form-control" type="number" id="nu1{{$SalaryAndcommission->id}}" value="{{$SalaryAndcommission->salary}}" name="salary"> </td>
                        <td> <input class="form-control" type="number" id="nu2{{$SalaryAndcommission->id}}" onchange="calculate({{$SalaryAndcommission->id}})" name="discoound" value="{{($SalaryAndcommission->discoound) ??'0'}}">  </td>
                        <td> <input class="form-control" type="number" onchange="calculate({{$SalaryAndcommission->id}})" id="nu3{{$SalaryAndcommission->id}}" name="borrow" value="{{($SalaryAndcommission->borrow) ??'0'}}"> </td>
                        <td> <input class="form-control" type="number" onchange="calculate({{$SalaryAndcommission->id}})" id="nu4{{$SalaryAndcommission->id}}" name="absence" value="{{($SalaryAndcommission->absence) ??'0'}}" > </td>
                        <td> <input class="form-control" type="number" onchange="calculate({{$SalaryAndcommission->id}})" value="{{($SalaryAndcommission->commission) ??'0'}}" id="nu5{{$SalaryAndcommission->id}}" name="commission" > </td>
                        <td> <input class="form-control" type="number" disabled id="nu6{{$SalaryAndcommission->id}}" name="total" value="{{$SalaryAndcommission->total}}"> </td>
                        @if($SalaryAndcommission->is_confirmed==0)
                            <td style="vertical-align: middle; color: green; font-size: 18px;" id="{{$SalaryAndcommission->id}}">
                            <select class="form-select update_salary" data-id="{{$SalaryAndcommission->id}}" name="is_confirmed" id="update_salary">
                                <option value="" disabled> إختيار </option>
                                <option value=""> تم التحويل </option>
                                <option value="" selected> لم يتم التحويل </option>
                            </select>
                            </td>

                        @else

                            <td style="vertical-align: middle; color: green; font-size: 18px;"> <i
                                    class="fas fa-check-circle"></i> </td>

                        @endif
                        <td> <input class="form-control" type="file" id="" value="{{$SalaryAndcommission->invoice}}" name="invoice"> </td>

                        <td> <button class="stoped" data-bs-toggle="modal" data-bs-target="#updateEmployee"><i class=" far fa-file-alt me-1"></i> عرض
                                السجل </button> </td>

                    </tr>

                    <div class="modal fade" id="updateEmployee" tabindex="-1" role="dialog"
                         aria-labelledby="addEmployeeTitle" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-scrollable">
                            <div class="modal-content" id="modal-content">
                                <div class="modal-body">

                                    <div class="mod-content">
                                        <form action="{{route('admin.SalariesCommissions.edit',$SalaryAndcommission->id)}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div  class="dropzone">
                                                <div class="fallback">
                                                    <input name="photo" type="file" value="{{$SalaryAndcommission->photo}}">
                                                </div>
                                                <div class="dz-message needsclick">
                                                    <div class="">
                                                        <i class="display-6 fas mo-icon fa-user"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row pt-4">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="default-input"> إسم الموظف
                                                        </label>
                                                        <input class="form-control" type="text" id="default-input" name="name" value="{{$SalaryAndcommission->name}}"
                                                               placeholder="ادخل اسم الموظف">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="default-input">رقم الهوية</label>
                                                        <input class="form-control" type="number" id="default-input" value="{{$SalaryAndcommission->id_number}}"
                                                               name="id_number"  placeholder="ادخل رقم الهوية">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="default-input"> رقم الموظف
                                                        </label>
                                                        <input class="form-control" type="text" id="default-input" name="employ_number" value="{{$SalaryAndcommission->employ_number}}"
                                                               placeholder="ادخل رقم الموظف">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="default-input"> تاريخ المباشرة
                                                        </label>
                                                        <input class="form-control" type="date" id="default-input" name="commencement_date" value="{{$SalaryAndcommission->commencement_date}}"
                                                               placeholder="Default input">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="default-input"> تاريخ إنتهاء
                                                            الإقامة </label>
                                                        <input class="form-control" type="date" id="default-input" name="expire_residence" value="{{$SalaryAndcommission->expire_residence}}"
                                                        >
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="default-input"> رقم الجوال
                                                        </label>
                                                        <input class="form-control" type="text" id="default-input" name="phone" value="{{$SalaryAndcommission->phone}}"
                                                               placeholder="رقم الجوال">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="default-input"> الراتب الشهري
                                                        </label>
                                                        <input class="form-control" type="number" id="default-input" name="salary" value="{{$SalaryAndcommission->salary}}"
                                                               placeholder="ادخل قيمة الراتب">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="default-input"> حالة الموظف
                                                        </label>
                                                        <input class="form-control" type="text" id="default-input" name="status" value="{{$SalaryAndcommission->status}}"
                                                               placeholder="منتظم">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="default-input"> المسمى الوظيفي
                                                        </label>
                                                        <input class="form-control" type="text" id="default-input" name="job_title" value="{{$SalaryAndcommission->job_title}}"
                                                               placeholder="ادخل المسمى الوظيفى">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="default-input"> رصيد الأجازات
                                                        </label>
                                                        <input class="form-control" type="number" id="default-input" name="vacations" value="{{$SalaryAndcommission->vacations}}"
                                                               placeholder="عدد ايام الاجازات">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="default-input"> عدد أيام الغياب
                                                        </label>
                                                        <input class="form-control" type="number" id="default-input" name="absence" value="{{$SalaryAndcommission->absence}}"
                                                               placeholder="عدد ايام الغياب">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="default-input"> البريد الإلكتروني
                                                        </label>
                                                        <input class="form-control" type="email" id="default-input" name="email" value="{{$SalaryAndcommission->email}}"
                                                               placeholder="@gmail">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="default-input"> عقد الموظف
                                                        </label>
                                                        <input class="form-control" type="file" id="default-input" name="contract" value="{{$SalaryAndcommission->contract}}"
                                                               placeholder="@gmail">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="default-input"> رقم الأيبان
                                                        </label>
                                                        <input class="form-control" type="number" id="default-input" name="ipan" value="{{$SalaryAndcommission->ipan}}"
                                                               placeholder="رقم ال ipan">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer" id="modal-footer">
                                                <div class="w d-flex justify-content-between">
                                                    <button type="button" class="btn stoped pdf mx-2" data-bs-dismiss="modal">
                                                        download <i class="mx-1 far fa-file-pdf"></i> </button>
                                                    <div class="">
                                                        <button type="submit" class="btn stoped  mx-2"> حفظ التغييرات </button>
                                                        <button type="button" class="btn stoped " data-bs-dismiss="modal"> إغلاق
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div>

                    </tbody>
                @endforeach
                @endisset
            </div>

        </div>
    </div>

   @endsection
   @section('js')
<script>
    $('#changeFilter').on('change',function(){
       var val = $(this).val();
       var myUrl = "{{route('admin.SalariesCommissions')}}?month={{date('Y-m')}}&type=filter&filter="+val
       window.location = myUrl
       });
       $('#choseMonth').on('keyup keydown change', function(){
       var val = $(this).val();
       var myUrl = "{{route('admin.SalariesCommissions')}}?month="+val+"&type=month";
       window.location = myUrl
       });
</script>
{{--<script>--}}

{{--$(document).on('click', '#update_salary', function (e) {--}}
{{--e.preventDefault();--}}

{{--$.ajax({--}}
{{--type: 'post',--}}
{{--url: "{{route('admin.SalariesCommissions.update')}}",--}}
{{--data: formData,--}}
{{--processData: false,--}}
{{--contentType: false,--}}
{{--cache: false,--}}
{{--success: function (data) {--}}


{{--}--}}
{{--}, error: function (reject) {--}}
{{--}--}}
{{--});--}}
{{--});--}}
{{--</script>--}}
       <script>

           $('.update_salary').on('change', function() {
          //    alert("ggg");
       var id=  $(this).attr('data-id');

               $.ajax({
                   type:'GET',
                   url:"{{route('admin.SalariesCommissions.update')}}",
                   data:{
                       id:id,
                   },

                   success:function(res){
                       if(res['status']==true)
                       {
                           toastr.success('تم تحديث النسبة بنجاح');
                         //  location.reload();

                           $(`#${id}`).html('<i class="fas fa-check-circle"></i>');

                       }
                       else if(res['status']=='error')
                           toastr.error('يرجي التاكد من البيانات');
                       else
                           location.reload();

                   },
                   error: function(data){
                       location.reload();
                   }
               });



           });



       </script>


       <script>



               function calculate(id) {

                   var nu1 = $("#nu1"+id).val();
                   var nu2 = $("#nu2"+id).val();
                   var nu3 = $("#nu3"+id).val();
                   var nu4 = $("#nu4"+id).val();
                   var nu5 = parseInt($("#nu5"+id).val());
                   var total = (nu1) - (nu2) - (nu3) - (nu4);
                   $('#nu6'+id).val(total+nu5);
                   updatesalary,$id

               }


       </script>
<script>

    document.getElementById('downloadExcel').addEventListener('click', function () {
        var table2excel = new Table2Excel();

        table2excel.export(document.querySelectorAll("#datatable-buttons"));
    });
</script>

    <script>

        $('#searchForm').on('submit',function (e){
            e.preventDefault();
            var oldUrl=window.location.href;
            var date=oldUrl.split('?')[1];
            var val = $('#searchInput').val()
            var myUrl = $(this).attr('action')
            var all=val+'?'+date;

            myUrl = myUrl.replace(':search',all);
            window.location = myUrl
            window.location = myUrl
        })

    </script>


   @endsection

