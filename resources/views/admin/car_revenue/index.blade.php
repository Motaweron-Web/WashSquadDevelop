@extends('admin.layouts.inc.app')

@section('content')

    <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
        <div class="p-2">
            <button class="stoped" data-bs-toggle="modal" data-bs-target="#addNew">
                <i class="fas fa-plus me-2"></i>
                إضافة فاتورة
            </button>
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
                <button class="btn  exportExcel"> <i class="fas fa-download me-2"></i> Export Excel
                </button>
            </div>
        </div>
    </div>
    <!-- logs -->
    <section class="logs">
        <!-- single log -->
        <div class="singleLog flex-column ">
            <h5> عدد الطلبات </h5>
            <h4> {{\App\Models\Order::count()}} </h4>
        </div>
        @foreach(\App\Models\Service::where('level',1)->get() as $service)
            <div class="singleLog flex-column ">
                <h5>  {{$service->ar_title}} </h5>
                <h4>{{\App\Models\Order::where('service_id',$service->id)->count()}} </h4>
            </div>
        @endforeach
        <!-- end single log -->
        <!-- single log -->
        @foreach(\App\Models\Service::where('level',1)->get() as $service)

        <div class="singleLog flex-column ">
            <h5> ايراد {{$service->ar_title}} </h5>
            <h4> {{\App\Models\Order::where('service_id',$service->id)->sum('total_price')}} </h4>
        </div>
        @endforeach
        <!-- end single log -->
        <!-- single log -->
        <div class="singleLog flex-column active ">
            <h5> الايرادات </h5>
            <h4> {{\App\Models\Order::sum('total_price')}} </h4>
        </div>
        <!-- end single log -->
        <!-- single log -->
        @foreach(\App\Models\Payment::get() as $payment)
        <div class="singleLog flex-column active ">
            <h5> {{$payment->type}} </h5>
            <h4> {{\App\Models\Order::where('payment_method',$payment->id)->sum('total_price')}}  </h4>
        </div>
        @endforeach
        <!-- end single log -->
        <!-- single log -->
        <div class="singleLog flex-column active ">
            <h5> اولاين تطبيقات </h5>
            <h4> {{\App\Models\Order::where('distributor_employee_id','!=',NULL)->sum('total_price')}} </h4>
        </div>
        <!-- end single log -->
        <!-- single log -->
        <div class="singleLog flex-column gray">
            <h5> العمولة </h5>
            <h4> {{\App\Models\Order::sum('commission_value')}} </h4>
        </div>
        <!-- end single log -->
    </section>
    <div class="d-flex flex-wrap justify-content-end align-items-center ">
        <div class="d-flex flex-wrap justify-content-end ">
            <div class="p-2">
                <select id="choseCar"  class="form-select shadow-lg">
                    <option selected disabled > السيارة  </option>
                    @foreach(\App\Models\User::where('user_type',2)->get() as $driver)
                        <option value="{{$driver->id}}" @isset($car)   @if($car==$driver)  selected   @endif   @endisset> {{$driver->name}} </option>
                    @endforeach
                </select>
            </div>
            <div class="p-2">
                <button class="btn  exportExcel"> <i class="fas fa-download me-2"></i> Export Excel
                </button>
            </div>
        </div>
    </div>
    <section class="drivers">
        <!-- table -->
        <div class="table-responsive mb-0 rounded" data-pattern="priority-columns">
            <table id="datatable" class="table dt-responsive table-striped nowrap">
                <thead>
                <tr>
                    <th> كود السائق </th>
                    <th> تاريخ الطلب </th>
                    <th> المسوق </th>
                    <th> العدد </th>
                    <th> نوع الخدمة </th>
                    <th> الباقة </th>
                    <th> خدمة اضافة </th>
                    <th> رقم الجوال </th>
                    <th> الاجمالي </th>
                    <th> المكافأة الفورية </th>
                    <th> الدفع </th>
                    <th> الحالة </th>
                    <th> </th>
                </tr>
                </thead>
                <tbody>
              @foreach($orders as $order)
                <tr>
                    <td> {{$order->driver->id}} </td>
                    <td> {{$order->date}}</td>
                    <td> {{$order->distributor->full_name??'wash'}} </td>
                    <td id="number_of_cars-{{$order->id}}"> {{$order->number_of_cars}} </td>
                    <td> {{$order->service->ar_title}} </td>
                    <td>{{$order->sub_service->ar_title ??''}} </td>
                    <td>

                        @foreach($order->sub_sub_services as $index=> $service)
                            @if($index==0)
                                {{$service->ar_title}}
                            @else
                                -       {{$service->ar_title}}

                            @endif
                        @endforeach

                    </td>
                    <td> <a href="tel:">{{$order->user->phone_code??''}}{{$order->user->phone??''}}</a> </td>
                    <td id="total_price-{{$order->id}}"> {{$order->total_price}}</td>
                    <td id="instant_reward-{{$order->id}}"> {{$order->user->instant_reward??''}} </td>
                    <td id="payment-{{$order->id}}"> {{$order->payment->type}} </td>
                    <td>
                        <select class="form-select">
                            <option value="1" selected> لم يعتمد </option>
                            <option value="2"> تم الاعتماد </option>
                        </select>
                    </td>
                    <td>
                        <div class="actionsIcons">
                            <a href="#!" data-id="{{$order->id}}" class="edit edit-order-revenue" data-bs-toggle="modal" data-bs-target="#edit">
                                <i class="fas fa-edit"></i> </a>
                        </div>
                    </td>
                </tr>
              @endforeach
                </tbody>
            </table>
{!! $orders->links() !!}
        </div>
    </section>
    <!-- Modal -->
    <div class="modal fade discountsModal driversModal" id="edit" tabindex="-1" aria-labelledby="editLabel">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editLabel"> +966542188234 </h5>
                    <i class="fa fa-times" data-bs-dismiss="modal" aria-label="Close"></i>
                </div>
                <div class="modal-body">
                    <div class="edit">
                        <div class="mb-3">
                            <label class="form-label"> ملاحظات العمليات </label>
                            <textarea class="form-control" rows="5" id="m-notes"></textarea>
                        </div>
                        <input type="hidden" id="m-order-id">
                        <input type="hidden" id="m-user-id">

                        <div class="row">
                            <label class="form-label"> عدد السيارات </label>
                            <div class="col-10 p-2">
                                <input class="form-control" id="m-number_of_cars" type="number">
                            </div>
                        </div>
                        <div class="row">
                            <label class="form-label"> رصيد المحفظة </label>
                            <div class="col-10 p-2">
                                <input class="form-control" id="m-balance" type="number">
                            </div>
                            <div class="col-2 p-2">
                                <button class=" btn mainBtn h-100 w-100 changeBalance"> اضافة </button>
                            </div>
                        </div>
                        <div class="row">
                            <label class="form-label"> مكافاءات فورية </label>
                            <div class="col-10 p-2">
                                <input class="form-control" id="m-instant_reward" type="number">
                            </div>
                            <div class="col-2 p-2">
                                <button class=" btn mainBtn h-100 w-100 change-instant-reward"> اضافة </button>
                            </div>
                        </div>
                        <div class="my-4">
                            <label class="form-label mb-4 "> طريقة الدفع </label>
                            <div class="d-flex align-items-center " id="m-payment">
                                @foreach(\App\Models\Payment::get() as $payment)
                                <div class="form-check px-4">
                                    <input class="form-check-input" type="radio" name="pay" id="pay1"
                                           value="option1">
                                    <label class="form-check-label" for="pay1">
                                        {{$payment->type}}
                                    </label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn orangeBtn car-revenue-order"> حفظ و إغلاق </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade discountsModal driversModal" id="addNew" tabindex="-1"
         aria-labelledby="addNewLabel">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addNewLabel"> إضافة فاتورة جديدة </h5>
                    <i class="fa fa-times" data-bs-dismiss="modal" aria-label="Close"></i>
                </div>
                <div class="modal-body">
                    <div class="addNew">

                        <div class="row">
                            <div class="col-6 p-2">
                                <label class="form-label"> كود السائق </label>
                                <select class="form-select " name="driver_id" id="driver_id">
                                    <option selected disabled> اختر السائف  </option>
                                    @foreach(\App\Models\User::where('user_type',2)->get() as $driver)
                                        <option value="{{$driver->id}}" {{$driver->id == $order->driver_id?'selected':''}}>{{$driver->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6 p-2">
                                <label class="form-label"> تاريخ الطلب </label>
                                <input class="form-control" name="date" id="date" type="date">
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="default-input"> فترة الطلب </label>
                                    <input class="form-control" type="time" name="order_time" id="a-order_time">
                                </div>
                            </div>
                            <div class="col-6 p-2">
                                <label class="form-label"> نوع الخدمة </label>
                                <select class="form-select " name="service_id" id="service_id">
                                    <option selected disabled> اختر  </option>
                                   @foreach(\App\Models\Service::where('level',1)->get() as $service)
                                      <option value="{{$service->id}}">{{$service->ar_title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="default-input"> إسم العميل
                                    </label>
                                    <input class="form-control"  name="full_name" type="text" id="a-full_name"
                                           placeholder="بكري">
                                </div>
                            </div>
                            <div class="col-6 p-2">
                                <label class="form-label"> رقم الجوال </label>
                                <input class="form-control" type="number" name="phone" id="phone">
                            </div>
                            <div class="col-6 p-2">
                                <label class="form-label"> عدد السيارات </label>
                                <input class="form-control" type="number" name="number_of_cars" id="number_of_cars">

                            </div>
                            <div class="col-6 p-2">
                                <label class="form-label"> مكافاءات فورية </label>
                                <input class="form-control" type="text" name="instant_reward" id="instant_reward">
                            </div>
                            <div class="col-12 p-2">
                                <label class="form-label"> الاجمالي </label>
                                <input class="form-control" disabled type="text">
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="default-input"> ماركة السيارة
                                    </label>
                                    <select  class="form-select mo-form-select" name="car_type1" id="d_selectCarType">
                                        <option disabled >اختر الماركة </option>
                                        @foreach(\App\Models\CarType::where('level',1)->get() as $car)

                                            <option value="{{$car->id}}">{{$car->ar_title}}</option>

                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="default-input"> الفئة </label>
                                    <select  class="form-select mo-form-select" name="car_type2" id="d_sub_type_id">
                                        <option disabled selected>اختر الماركة اولا</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="default-input"> لوحة السيارة </label>
                                    <input class="form-control" name="car_blade_number" type="number" id="a-car_blade_number"
                                           placeholder="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="default-input"> الحي </label>
                                    <select class="form-select mo-form-select" name="place_id" id="d_selectPlaceId">
                                        <option   disabled selected>الحي</option>
                                        @foreach(\App\Models\Place::get() as $place)
                                            <option value="{{$place->id}}">{{$place->ar_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-6 p-2">
                                <label class="form-label mb-4 "> طريقة الدفع </label>
                                <div class="d-flex  flex-column ">
                                    @foreach(\App\Models\Payment::get() as $payment)
                                    <div class="form-check px-4">
                                        <input class="form-check-input payment_id"  type="radio" name="payment_method" id="{{$payment->id}}"
                                               value="{{$payment->id}}">
                                        <label class="form-check-label" for="{{$payment->id}}">
                                            {{$payment->type}}
                                        </label>
                                    </div>
                                    @endforeach

                                </div>
                            </div>






                            <div class="col-6 p-2">
                                <label class="form-label  mb-4 "> الخدمات الاضافية </label>

                                @foreach(\App\Models\Service::where('level',3)->get() as $service)
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" name="sub_sub_services[]" value="{{$service->id}}" id="service1">
                                    <label class="form-check-label" for="service1">
                                       {{$service->ar_title}}
                                    </label>
                                </div>
                                @endforeach

                            </div>

                        </div>



                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn orangeBtn" id="add-invoice"> حفظ و إغلاق </button>
                </div>
            </div>
        </div>
    </div>




@endsection


@section('js')
<script>
    $('#choseCar').on('keyup keydown change', function(){
        var oldUrl=window.location.href;
        var date=oldUrl.split('?')[1];
    var val = $(this).val();
    var myUrl = "{{route('admin.revenue.search.car',':car')}}";
    var string = val;
        var all=val+'?'+date;

        myUrl = myUrl.replace(':car',all);
    window.location = myUrl
    window.location = myUrl
    });
</script>
<script>

    $('#changeFilter').on('change',function(){
        var val = $(this).val();
        var myUrl = "{{route('admin.cars.revenue')}}?month={{date('Y-m')}}&type=filter&filter="+val
        window.location = myUrl
    });
    $('#choseMonth').on('keyup keydown change', function(){
        var val = $(this).val();
        var myUrl = "{{route('admin.cars.revenue')}}?month="+val+"&type=month";
        window.location = myUrl
    });

</script>

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
    </script>
<script>
    $('#d_selectCarType').on('change', function() {
        var id = this.value;
        $(`#d_sub_type_id`).html(' <option value=""  disabled>إختر الماركة أولا</option>');

        $.ajax({
            type: 'GET',
            url: "{{route('getsubcarbymaincar')}}",
            data: {
                id: id,
            },

            success: function (res) {
                if (res['status'] == true) {

                    var cartypes = ``;
                    var default_value=` <option disabled selected>اختر الفئة الان  </option>`;
                    $(`#d_sub_type_id`).html();
                    $(`#d_sub_type_id`).html(default_value);

                    for (var i = 0; i < res['cars'].length; i++) {
                        cartypes = `<option value="${res['cars'][i]['id']}">${res['cars'][i]['ar_title']}</option>`;
                        $(`#d_sub_type_id`).append(cartypes);

                    }

                } else if (res['status'] == false)
                    location.reload();


            },
            error: function (data) {
                alert('error');
            }
        });
    });
</script>

<script>

    $('#add-invoice').on('click',(function(e) {
        e.preventDefault();
        var phone=$('#phone').val();
      var driver_id=$(`#driver_id`).val();
      var date=$('#date').val();
      var service_id=$('#service_id').val();
      var number_of_cars=$('#number_of_cars').val();
      var type_id=$('#d_selectCarType').val();
      var sub_type_id=$('#d_sub_type_id').val();
        var sub_sub_services = [];
        $(':checkbox:checked').each(function(i){
            sub_sub_services[i] = $(this).val();
        });
        var payment_method = $("input[name='payment_method']:checked").val();
    var instant_reward=$('#instant_reward').val();
    var full_name=$('#a-full_name').val();
    var place_id=$('#d_selectPlaceId').val();
    var order_time=$('#a-order_time').val();
    var car_blade_number=$('#a-car_blade_number').val();
        $.ajax({
            type: 'get',
            url: "{{route('admin.revenue.add.invoice')}}",
            data: {
                place_id:place_id,
                order_time:order_time,
                car_blade_number:car_blade_number,
                full_name:full_name,
                phone:phone,
                driver_id:driver_id,
                date:date,
                service_id:service_id,
                number_of_cars:number_of_cars,
                type_id:type_id,
                sub_type_id:sub_type_id,
                sub_sub_services:sub_sub_services,
                payment_method:payment_method,
                instant_reward:instant_reward,
            },

            success: function (res) {

                if (res['status'] == true) {
                    $('#exampleModalScrollable').modal('toggle');
                    toastr.success('تم اضافة طلبك بنجاح');
                    location.reload();

                } else if (res['status'] == 'error') {
                    toastr.error('يرجي التاكد من البيانات');
                }
                else
                    toastr.success('يرجي التاكد من ');
            },
            error: function (data) {
                toastr.error('يرجي التاكد من ');
            }
        });
    }));



</script>


    <script>

        $('.edit-order-revenue').click(function (){

            var id=$(this).attr('data-id');
            $.ajax({
                type: 'GET',
                url: "{{route('admin.car.revenue.getOrderById')}}",
                data: {
                    id: id,
                },

                success: function (res) {
                    if (res['status'] == true) {

                        $('#m-number_of_cars').val(res['order']['number_of_cars']);
                        $('#m-notes').val(res['order']['notes']);
                        $('#m-balance').val(res['user']['balance']);
                        $('#m-instant_reward').val(res['user']['instant_reward']);
                        $('#m-user-id').val(res['user']['id']);
                        $('#m-order-id').val(res['order']['id']);


                        var cartona=``;
                        var checked='';
                        for(var i=0;i<res['payments'].length;i++){
                            if(res['order']['payment_method']==res['payments'][i]['id'])
                            {
                                checked=`checked`;
                            }
                            else{
                                checked=``;

                            }
                            cartona +=` <div class="form-check px-4">
                                    <input class="form-check-input" type="radio" ${checked} name="pay" id="pay1"
                                           value="${res['payments'][i]['id']}">
                                    <label class="form-check-label" for="pay1">
                                        ${res['payments'][i]['type']}
                            </label>
                        </div>`
                        }
                      $(`#m-payment`).html(cartona);
                    } else if (res['status'] == false)
                        location.reload();


                },
                error: function (data) {
                    alert('error');
                }
            });

        });




    </script>

<script>

    $('.changeBalance').on('click', function() {
        var id=$('#m-user-id').val();
        var order_id=$('#m-order-id').val();
        var balance=$('#m-balance').val();
        $.ajax({
            type:'GET',
            url:"{{route('admin.editRevenueBalance')}}",
            data:{
                id:id,
                balance:balance,
            },

            success:function(res){
                if(res['status']==true)
                {
                    toastr.success('تم تحديث المحفظة  بنجاح');
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

<script>

    $('.change-instant-reward').on('click', function() {
        var id=$('#m-user-id').val();
        var order_id=$('#m-order-id').val();
        var instant_reward=$('#m-instant_reward').val();
        $.ajax({
            type:'GET',
            url:"{{route('admin.addInstantReward')}}",
            data:{
                id:id,
                instant_reward:instant_reward,
            },

            success:function(res){
                if(res['status']==true)
                {
                    toastr.success('تم تحديث المكافئة الفورية   بنجاح');
                    $(`#instant_reward-${order_id}`).text(res['instant_reward']);
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




<script>

    $('.car-revenue-order').on('click', function() {
        var user_id=$('#m-user-id').val();
        var order_id=$('#m-order-id').val();
        var instant_reward=$('#m-instant_reward').val();
        var balance=$('#m-balance').val();
        var number_of_cars=$('#m-number_of_cars').val();
        var notes=$('#m-notes').val();
        var payment_id = $("input[name='pay']:checked").val();
        $.ajax({
            type:'GET',
            url:"{{route('admin.editOrderCarRevenue')}}",
            data:{
               user_id:user_id,
               order_id:order_id,
               instant_reward:instant_reward,
               balance:balance,
               number_of_cars:number_of_cars,
               notes:notes,
               payment_id:payment_id,

            },

            success:function(res){
                if(res['status']==true)
                {
                    toastr.success('تم التحديث   بنجاح');
                    $(`#instant_reward-${order_id}`).text(res['user']['instant_reward']);
                    $(`#notes-${order_id}`).text(res['order']['notes']);
                    $(`#number_of_cars-${order_id}`).text(res['order']['number_of_cars']);
                    $(`#total_price-${order_id}`).text(res['order']['total_price']);
                    $(`#payment-${order_id}`).text(res['payment']);
                    $('#edit').modal('toggle');

                  //  location.reload();
                }
                else if(res['status']=='error') {
                    toastr.error('يرجي التاكد من البيانات');
                    toastr.error(res['message']);
                }
                else
                {
                   // location.reload();

                }

            },
            error: function(data){
                alert('error');
            }
        });





    });





</script>










@endsection
