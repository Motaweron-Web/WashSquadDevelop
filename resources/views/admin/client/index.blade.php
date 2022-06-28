@extends('admin.layouts.inc.app')

@section('content')

    @php
    $count=[];
$users=\App\Models\User::get();
foreach ($users as $user)
    {
        $val=$user->orders->count() ?? 0;
array_push($count,$val);
$number=max($count);
    }
$number=max($count);

$services=\App\Models\Service::where('level',1)->get();

    @endphp



    <!-- date -->
    <div class="row justify-content-between align-items-center mb-3">
        <div class=" col-md-4 p-2">
            <button class="stoped vip " data-bs-toggle="modal" data-bs-target="#VIPDiscount ">
                <h6 class="d-inline-block fw-bold m-0"> VIP discount </h6>
                <i class="fas fa-cog ms-2"></i>
            </button>
        </div>
        <form action="{{route('admin.search.client.mobile')}}"  class="col-md-8 row flex-wrap justify-content-end align-items-center mb-3"  method="get">
        <div class="col-md-8 row flex-wrap justify-content-end align-items-center mb-3">

            <div class=" col ">
                <button class="btn btn-success">بحث بالموبيل</button>
            </div>
            <div class=" col p-2">
                <input type="search" @isset($search)  value="{{$search}}"  @endisset name="search" class="form-control searchInput" placeholder="phone number">
            </div>
            <div class=" col p-2">
                <input type="date" @isset($date)  value="{{$date}}"  @endisset id="choseMonth" class="form-control">
            </div>
        </div>
        </form>

    </div>
    <!-- Regions -->

    <section class="regions ">
        <!-- regions -->
        <div class="allRegions">
            <!-- single Region -->
            <div class="singleRegion align-items-end active">
                <h5> عملاء <br>
                    تمت خدمته </h5>
                <a href="{{route('admin.getClientsByFilter','done')}}"> <i class="fas fa-arrow-circle-down"></i> </a>
            </div>
            <!-- end single Region -->
            <!-- single Region -->
            <div class="singleRegion align-items-end">
                <h5> عملاء <br>
                    تم الالغاء </h5>
                <a href="{{route('admin.getClientsByFilter','cancel')}}"> <i class="fas fa-arrow-circle-down"></i> </a>
            </div>
            <!-- end single Region -->
            <!-- single Region -->
            <div class="singleRegion align-items-end">
                <h5> عملاء <br>
                    لم تتم خدمتهم </h5>
                <a href="{{route('admin.getClientsByFilter','notServe')}}"> <i class="fas fa-arrow-circle-down"></i> </a>
            </div>
            <!-- end single Region -->
            <!-- single Region -->
            <div class="singleRegion align-items-end">
                <h5> عملاء <br>
                    التطبيق الجدد </h5>
                <a href="{{route('admin.getClientsByFilter','new')}}"> <i class="fas fa-arrow-circle-down"></i> </a>
            </div>
            <!-- end single Region -->
            <!-- single Region -->
            <div class="singleRegion align-items-end">
                <h5>عملاء <br>
                    vip </h5>
                <a href="{{route('admin.getClientsByFilter','vip')}}"> <i class="fas fa-arrow-circle-down"></i> </a>
            </div>
            <!-- end single Region -->
        </div>
        <!-- end regions -->
        <div class="d-flex flex-wrap justify-content-end mb-3">
            <div class="p-2">
                <select class="form-select shadow-lg" id="searchByRegion">
                    <option selected disabled> المنطقة </option>
                    @foreach($places as $place)
                    <option @isset($region) @if($region==$place->id)  selected  @endif @endisset value="{{$place->id}}">{{$place->ar_name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="p-2">
                <select class="form-select shadow-lg" id="searchByCountOrder">
                    <option selected disabled> مرات الطلب </option>
                  @for($i=0;$i<=$number;$i++)
                    <option  @isset($countOrder)  @if($countOrder==$i) selected @endif @endisset value="{{$i}}">{{$i}}</option>
                    @endfor
                </select>
            </div>
            <div class="p-2">
                <select class="form-select shadow-lg" id="searchByPayment">
                    <option selected disabled> الدفع </option>
                    @foreach(\App\Models\Payment::get() as $payment)
                    <option @isset($pay)  @if($pay==$payment->id)  selected @endif  @endisset value="{{$payment->id}}">{{$payment->type}}</option>
                    @endforeach
                </select>
            </div>
            <div class="p-2">
                <select class="form-select shadow-lg" id="searchByService">
                    <option selected disabled> نوع الخدمة </option>
                    @foreach($services as $service)
                    <option @isset($ser)  @if($ser==$service->id) selected @endif @endisset value="{{$service->id}}">{{$service->ar_title}}</option>
                    @endforeach
                </select>
            </div>
            <div class="p-2">
                <a href="{{route('admin.export.user')}}" class="btn  exportExcel"> <i class="fas fa-download me-2"></i> Export Excel
                </a>
            </div>
        </div>
        <!-- table -->
        <div class="table-responsive mb-0 rounded" data-pattern="priority-columns">
            <table id="datatable" class="table dt-responsive table-striped nowrap">
                <thead>
                <tr>
                    <th> اسم العميل </th>
                    <th> رقم الجوال </th>
                    <th> اسم الحي </th>
                    <th> مرات الطلب </th>
                    <th> رصيد المحفظة </th>
                    <th> الدفع </th>
                    <th> الحالة </th>
                    <th> حساب مميز
                        <span style="display:block ; font-size: 8px;"> نسبة خصم على طلب</span>
                    </th>
                    <th>إضافة <br>
                        رصيد </th>
                    <th> </th>
                    <th> </th>
                </tr>
                </thead>
                <tbody>
                @foreach($clients as $client)
                <tr class="serv-border">
                    <td> {{$client->full_name}} </td>
                    <td>{{$client->phone_code}} {{$client->phone}} </td>
                    <td> {{$client->place->ar_name??''}} </td>
                    <td> {{$client->orders->count() ?? 0}} </td>
                    <td id="{{$client->id}}"> {{$client->balance}} </td>
                    <td> pos </td>

                    <td>
                        @if($client->is_active==0)
                        <span class="closed change_active" data-id="{{$client->id}}"> مغلق </span>
                        @else
                            <span class="active change_active" data-id="{{$client->id}}"> مفعل </span>
                        @endif
                    </td>
                    <td>
                        <div class="form-check form-switch vipCheck ms-3">
                            <input class="form-check-input change_vip" data-id="{{$client->id}}"  @if($client->is_vip==1) checked  @endif id="" type="checkbox" role="switch">
                        </div>
                    </td>
                    <td>
                        <a href="#!" class="addBalance insertId" data-id="{{$client->id}}" >
                            <img src="{{asset('assets/admin/images/icons/addPalance.svg')}}"
                                 style="height: 30px; object-fit:contain " alt="" data-bs-toggle="modal"
                                 data-bs-target="#cashback">
                        </a>
                    </td>
                    <td>
                        <a href="{{route('admin.client.profile',$client->id)}}" class="btn mainBtn "> <i class="far fa-file-alt me-1"></i> السجل
                        </a>
                    </td>
                    <td>
                        <a href="#!" class="block">
                            <img src="{{asset('assets/images/icons/block.svg')}}" alt="">
                        </a>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
            <nav aria-label="...">
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" href="{{$clients->previousPageUrl()}}">Previous</a>
                    </li>
                     @for($i=1;$i<=$clients->lastPage();$i++)
                    <li class="page-item"><a class="page-link" href='?page={{$i}}'> {{$i}}</a></li>
                     @endfor
                    <li class="page-item ">
                        <a class="page-link"  href="{{$clients->nextPageUrl()}}">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </section>

    <!-- End Regions -->
    <!-- Modal -->
    <div class="modal fade discountsModal driversModal" id="VIPDiscount" tabindex="-1"
         aria-labelledby="VIPDiscountLabel">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="VIPDiscountLabel"> VIP discount  </h5>
                    <i class="fa fa-times" data-bs-dismiss="modal" aria-label="Close"></i>
                </div>
                <div class="modal-body">
                    <div class="VIPDiscount">
                        <div class="text-center">
                            <div class="form-check form-switch vipCheck ">
                                <input class="form-check-input" id="wash" type="checkbox" role="switch"
                                       checked>
                            </div>

                            <h4> نسبة الخصم </h4>
                            <h6 class="price"> <span> 20 </span> % </h6>
                        </div>
                        <div class="row">
                            <label class="form-label"> نسبة الخصم للعملاء المميزيين  </label>
                            <div class="col-10 p-2">
                                <input class="form-control" name="vib_discount" id="vib_discount" type="text">
                            </div>
                            <div class="col-2 p-2">
                                <button class=" btn mainBtn h-100 w-100 addToSetting" data-bs-dismiss="modal"> تطبيق </button>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn orangeBtn" data-bs-dismiss="modal">   إغلاق </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade discountsModal driversModal" id="cashback" tabindex="-1"
         aria-labelledby="cashbackLabel">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cashbackLabel"> +966542188234 </h5>
                    <i class="fa fa-times" data-bs-dismiss="modal" aria-label="Close"></i>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="client-id">
                    <div class="cashback">
                        <div class="text-center">
                            <img src="{{asset('assets/images/icons/account balance.svg')}}" alt="">
                            <h4>رصيد الكاش باك</h4>
                            <h6 class="price"> <span> 20 </span> ريال </h6>
                        </div>
                        <div class="row">
                            <label class="form-label"> رصيد المحفظة </label>
                            <div class="col-10 p-2">
                                <input class="form-control" name="balance" id="balanceInCart" type="text">
                            </div>
                            <div class="col-2 p-2">
                                <button class=" btn mainBtn h-100 w-100 changeBalance"  > اضافة </button>
                            </div>
                        </div>
                        <div class="row">
                            <label class="form-label"> نسبة خصم صالح لمرة واحد </label>
                            <div class="col-10 p-2">
                                <input class="form-control" name="percentage" id="percentage" type="text">
                            </div>
                            <div class="col-2 p-2">
                                <button class=" btn mainBtn h-100 w-100 changePercentage" > اضافة </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn orangeBtn" data-bs-dismiss="modal">   إغلاق </button>
                </div>
            </div>
        </div>
    </div>



@endsection

@section('js')



    <script>

        $('#choseMonth').on('keyup keydown change', function(){
            var val = $(this).val();
            var myUrl = "{{route('admin.search.client.date')}}?date="+val+"";
            window.location = myUrl
        });
        $('#searchByRegion').on('change', function() {
            var val = $(this).val();
            var myUrl = "{{route('admin.search.client.place')}}?region="+val+"";
            window.location = myUrl
        });
        $('#searchByCountOrder').on('change', function() {
            var val = $(this).val();
            var myUrl = "{{route('admin.search.client.count.order')}}?countOrder="+val+"";
            window.location = myUrl
        });
        $('#searchByService').on('change', function() {
            var val = $(this).val();
            var myUrl = "{{route('admin.search.client.service')}}?service="+val+"";
            window.location = myUrl
        });
        $('#searchByPayment').on('change', function() {
            var val = $(this).val();
            var myUrl = "{{route('admin.client.search.payment')}}?payment="+val+"";
            window.location = myUrl
        });

        $('.change_vip').on('click', function() {
            var id=$(this).attr('data-id');
            $.ajax({
                type:'GET',
                url:"{{route('admin.client.change.vip')}}",
                data:{
                    id:id,
                },

                success:function(res){
                    if(res['status']==true)
                    {
                        toastr.success('تم التحديث بنجاح');



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
        $('.insertId').on('click', function() {
            var id=$(this).attr('data-id');
           $('#client-id').val(id);

        });


        $('.changeBalance').on('click', function() {
            var id=$('#client-id').val();

            var balance=$('#balanceInCart').val();
            $.ajax({
                type:'GET',
                url:"{{route('admin.client.add.balance')}}",
                data:{
                    id:id,
                    balance:balance,
                },

                success:function(res){
                    if(res['status']==true)
                    {
                        toastr.success('تم تحديث المحفظة  بنجاح');
                        $(`#${id}`).text(res['balance']);
                    }
                    else if(res['status']=='error') {
                        toastr.error('يرجي التاكد من البيانات');
                        toastr.error(res['message']);
                    }
                    else
                        location.reload();

                },
                error: function(data){
                    alert('error');
                }
            });





        });

        $('.addToSetting').on('click', function() {
           var discount= $('#vib_discount').val();


        });
        $('.change_active').on('click', function() {
            var id=$(this).attr('data-id');
            var element=$(this);
            $.ajax({
                type:'GET',
                url:"{{route('admin.client.change.active')}}",
                data:{
                    id:id,
                },

                success:function(res){
                    if(res['status']==true)
                    {
                        toastr.success('تم التحديث بنجاح');

                        if(res['data']==0)
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




        $('.change_blocked').on('click', function() {
            var id=$(this).attr('data-id');
            var element=$(this);
            $.ajax({
                type:'GET',
                url:"{{route('admin.client.change.active')}}",
                data:{
                    id:id,
                },

                success:function(res){
                    if(res['status']==true)
                    {
                        toastr.success('تم التحديث بنجاح');

                        if(res['data']==0)
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












        {{--var table =  $("#datatable").DataTable({--}}
        {{--    // lengthChange: false,--}}
        {{--    buttons: [ 'copy', 'excel', 'pdf', 'colvis' ],--}}
        {{--    dom: 'Bfrtip',--}}
        {{--    responsive: 1,--}}
        {{--    "processing": true,--}}
        {{--    // "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ]--}}
        {{--    "ordering": true,--}}
        {{--    "searching": true,--}}
        {{--    "pageLength":10,--}}
        {{--    'iDisplayLength': 10,--}}
        {{--    "bPaginate": false,--}}

        {{--    "language": {--}}
        {{--        "sProcessing":   "{{trans('admin.sProcessing')}}",--}}
        {{--        "sLengthMenu":   "{{trans('admin.sLengthMenu')}}",--}}
        {{--        "sZeroRecords":  "{{trans('admin.sZeroRecords')}}",--}}
        {{--        "sInfo":         "{{trans('admin.sInfo')}}",--}}
        {{--        "sInfoEmpty":    "{{trans('admin.sInfoEmpty')}}",--}}
        {{--        "sInfoFiltered": "{{trans('admin.sInfoFiltered')}}",--}}
        {{--        "sInfoPostFix":  "",--}}
        {{--        "sSearch":       "{{trans('admin.sSearch')}}:",--}}
        {{--        "sUrl":          "",--}}
        {{--        "oPaginate": {--}}
        {{--            "sFirst":    "{{trans('admin.sFirst')}}",--}}
        {{--            "sPrevious": "{{trans('admin.sPrevious')}}",--}}
        {{--            "sNext":     "{{trans('admin.sNext')}}",--}}
        {{--            "sLast":     "{{trans('admin.sLast')}}"--}}
        {{--        }--}}
        {{--    },--}}
        {{--    order: [--}}
        {{--        // [2, "desc"]--}}
        {{--    ],--}}
        {{--});--}}
        {{--table.buttons().container()--}}
        {{--    .appendTo( '#exportexample_wrapper .col-md-6:eq(0)' );--}}


        $('.changePercentage').on('click', function() {
            var id=$('#client-id').val();

            var percentage=$('#percentage').val();
            $.ajax({
                type:'GET',
                url:"{{route('admin.client.change.percentage')}}",
                data:{
                    id:id,
                    percentage:percentage,
                },

                success:function(res){
                    if(res['status']==true)
                    {
                        toastr.success('تم تحديث النسبة بنجاح');
                    }
                    else if(res['status']=='error') {
                        toastr.error('يرجي التاكد من البيانات');
                        toastr.error(res['message']);
                    }
                    else
                        location.reload();

                },
                error: function(data){
                    alert('error');
                }
            });





        });


        $(function(){
            var dtToday = new Date();

            var month = dtToday.getMonth() + 1;
            var day = dtToday.getDate();
            var year = dtToday.getFullYear();
            if(month < 10)
                month = '0' + month.toString();
            if(day < 10)
                day = '0' + day.toString();

            var maxDate = year + '-' + month + '-' + day;
            $('#choseMonth').attr('max', maxDate);
        });






    </script>





@endsection

@section('style')






@endsection
