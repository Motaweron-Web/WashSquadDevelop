@extends('admin.layouts.inc.app')

@section('content')


    <!-- date -->
    <div class="row justify-content-between align-items-center mb-3">
        <div class=" col-md-8 p-2">
            <ol class="breadcrumb ">
                <li class="breadcrumb-item"> <a href="{{route('admin.get.clients')}}"> العملاء
                    </a> </li>
                <li class="breadcrumb-item active"> <a href="#!"> سجل العميل {{$client->full_name}} </a> </li>
            </ol>
        </div>
        <div class="col-md-4 row flex-wrap justify-content-end align-items-center mb-3">
            <div class=" col p-2">
                <input type="date"  @isset($date)  value="{{$date}}"  @endisset id="choseMonth" class="form-control">
            </div>
        </div>
    </div>
    <!-- logs -->
    <section class="logs">
        <!-- single log -->
        <div class="singleLog flex-column ">
            <h5> عدد الطلبات </h5>
            <h4>
            {{\App\Models\Order::where('user_id',$client->id)->count()}}
            </h4>
        </div>
        <!-- end single log -->
        <!-- single log -->
        <div class="singleLog flex-column ">
            <h5> المكتملة </h5>
            <h4>             {{\App\Models\Order::where('user_id',$client->id)->where('status',13)->count()}}
            </h4>
        </div>
        <!-- end single log -->
        <!-- single log -->
        <div class="singleLog flex-column ">
            <h5> الملغية </h5>
            <h4> {{\App\Models\Order::where('user_id',$client->id)->where('status',5)->count()}} </h4>
        </div>
        <!-- end single log -->
        <!-- single log -->
        <div class="singleLog flex-column ">
            <h5> الغسيل </h5>
            <h4> {{\App\Models\Order::where('user_id',$client->id)->where('service_id',1)->count()}}</h4>
        </div>
        <!-- end single log -->
        <!-- single log -->
        <div class="singleLog flex-column ">
            <h5> التليمع </h5>
            <h4> {{\App\Models\Order::where('user_id',$client->id)->where('service_id',2)->count()}}</h4>
        </div>
        <!-- end single log -->
        <!-- single log -->
        <div class="singleLog flex-column ">
            <h5> التعقيم </h5>
            <h4> {{\App\Models\Order::where('user_id',$client->id)->where('service_id',78)->count()}}</h4>
        </div>
        <!-- end single log -->
        <!-- single log -->
        <div class="singleLog flex-column active">
            <h5> الايراد </h5>
            <h4> {{$total_price}} </h4>
        </div>
        <!-- end single log -->
    </section>
    <!-- end logs -->
    <section class="packages">
        <!-- singlePackage -->
        <div class="singlePackage">
            <div class="row">
                <div class="col p-2">
                    <div class="packageData">
                        <h6 class="title"> رقم العميل </h6>
                        <p> {{$client->id}} </p>
                    </div>
                </div>
                <div class="col p-2">
                    <div class="packageData">
                        <h6 class="title"> اسم العميل </h6>
                        <p>{{$client->full_name}} </p>
                    </div>
                </div>
                <div class="col p-2">
                    <div class="packageData">
                        <h6 class="title"> رقم الجوال </h6>
                        <p> <a href="tel:">{{$client->phone_code}}{{$client->phone}}</a> </p>
                    </div>
                </div>
                <div class="col p-2">
                    <div class="packageData">
                        <h6 class="title"> لوحة السيارة </h6>
                        <p> {{$client->orders[0]->car_blade_number??''}} </p>
                    </div>
                </div>
                <div class="col p-2">
                    <div class="packageData">
                        <h6 class="title"> رصيد المحفظة </h6>
                        <p id="{{$client->id}}"> {{$client->balance}} </p>
                    </div>
                </div>


                <div class="col p-2">
                    <div class="packageData">
                        <h6 class="title"> حساب مميز </h6>
                        <div class="form-check form-switch vipCheck d-flex justify-content-center">
                            <input class="form-check-input change_vip" data-id="{{$client->id}}"  @if($client->is_vip==1) checked  @endif id="" type="checkbox" role="switch">
                        </div>
                    </div>
                </div>

                <div class="col p-2">
                    <div class="packageData">
                        <h6 class="title"> إضافة رصيد </h6>
                        <a href="#!" class="addBalance insertId" data-id="{{$client->id}}" >
                            <img src="{{asset('assets/admin/images/icons/addPalance.svg')}}"
                                 style="height: 30px; object-fit:contain " alt="" data-bs-toggle="modal"
                                 data-bs-target="#cashback">
                        </a>
                    </div>
                </div>
                <div class="col p-2">
                    <div class="packageData">
                        <h6 class="title"> حالة الحساب </h6>


                            @if($client->is_active==0)
                                <span class="closed change_active" data-id="{{$client->id}}"> مغلق </span>
                            @else
                                <span class="active change_active" data-id="{{$client->id}}"> مفعل </span>
                            @endif

                    </div>
                </div>


                <div class="col p-2">
                    <a href="#!" class="block">
                        <img src="{{asset('assets/admin/images/icons/block.svg')}}" alt="">
                    </a>
                </div>
            </div>
        </div>
        <!-- end singlePackage -->
    </section>
    <!-- End logs -->

    <!-- discounts -->
    <section class=" discounts drivers ">
        <!-- table -->
        <div class="table-responsive mb-0 rounded" data-pattern="priority-columns">
            <table id="datatable" class="table dt-responsive table-striped nowrap">
                <thead>
                <tr>

                    <th> رقم الطلب </th>
                    <th> تاريخ الطلب </th>
                    <th> الوقت </th>
                    <th> المزود </th>
                    <th> العدد </th>
                    <th> نوع الخدمة </th>
                    <th> الباقة </th>
                    <th> خدمة اضافة </th>
                    <th> الحى </th>
                    <th> الاجمالي </th>
                    <th> العمولة </th>
                    <th> لوحة السيارة </th>
                    <th> الدفع </th>
                    <th> الحالة </th>
                </tr>
                </thead>
                <tbody>
                 @foreach($orders as $order)
                <tr class="serv-border">

                    <td> {{$order->id}} </td>
                    <td> {{date_format($order->created_at,"Y/m/d ") }}</td>
                    <td> {{date_format($order->created_at," H:i") }} </td>
                    <td> wash </td>
                    <td> {{$order->number_of_cars}} </td>
                    <td>{{$order->service->ar_title}} </td>
                    <td>تلميع مكينة </td>
                    <td>  {{$order->sub_service->ar_title??''}} </td>
                    <td> {{$order->place->ar_name??''}} </td>
                    <td> {{$order->total_price}} </td>
                    <td> {{$order->commission_value}}</td>
                    <td> {{$order->car_blade_number}} </td>
                    <td> cash </td>
                    <td> <span
                              style="    padding: 4px 16px;
                    font-size: small;
                    border-radius: 100px;
                    background-color: #4F986E;
                    color: #ffffff;"
                    @if($order->status==1) class="purble  text-white" @elseif($order->status==2) class="blu  text-white" @elseif($order->status==11) class="yelo  text-white" @elseif($order->status==5) class="rd  text-white" @elseif($order->status==3) class="gry  text-white" @elseif($order->status==13) class="gren  text-white" @endif>
                            @if($order->status==1) جديد @elseif($order->status==2) جاري العمل @elseif($order->status==11) السائق بالطريق @elseif($order->status==5) تم الالغاء @elseif($order->status==3) انتهي العمل @elseif($order->status==13) تمت الخدمة @endif
                     </span> </td>
                </tr>
                 @endforeach

                </tbody>
            </table>

        </div>
    </section>

    <!-- Modal -->
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


            $.ajax({
                type:'GET',
                url:"{{route('admin.change.vipDiscount')}}",
                data:{
                    discount:discount,
                },

                success:function(res){
                    if(res['status']==true)
                    {
                        toastr.success('تم تحديث النسبة بنجاح');



                    }
                    else if(res['status']=='error')
                        toastr.error('يرجي التاكد من البيانات');
                    else
                        location.reload();

                },
                error: function(data){
                    alert('error');
                }
            });
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







    </script>





@endsection

@section('style')





@endsection
