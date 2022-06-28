@extends('admin.layouts.inc.app')

@section('content')

    <!-- breadcrumb -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item"> <a href="apps.html"> التطبيقات </a> </li>
            <li class="breadcrumb-item active"> <a href="#!"> تطبيق سرور </a> </li>
            <li class="breadcrumb-item active"> <a href="#!"> تقارير </a> </li>
        </ol>
        <div class="d-flex flex-wrap justify-content-end col-6 mb-3">
            <form class="col-md-6" id="searchForm" action="{{route('admin.app.filter.search',":search")}}">

                <div class="p-2 col-md-9">
                    <input type="search" @isset($search) value="{{$search}}"   @endisset name="search" id="searchInput" class="form-control "
                           placeholder="phone number ">
                </div>
            </form>
            <div class="p-2 w-50">
                <input id="choseMonth" @isset($date)   value="{{$date}}"    @endisset type="date" class="form-control ">
            </div>
        </div>
    </div>
    <!-- end breadcrumb -->
    <!-- logs -->
    <section class="logs">
        <!-- single log -->
        <div class="singleLog flex-column ">
            <h5> عدد الطلبات </h5>
            <h4> {{\App\Models\Order::count()}} </h4>
        </div>
        <!-- end single log -->
        <!-- single log -->
        <div class="singleLog flex-column ">
            <h5> المكتملة </h5>
            <h4> {{\App\Models\Order::where('status',13)->count()}}   </h4>
        </div>
        <!-- end single log -->
        <!-- single log -->
        <div class="singleLog flex-column ">
            <h5> الملغية </h5>
            <h4> {{\App\Models\Order::where('status',5)->count()}} </h4>
        </div>
        <!-- end single log -->
        <!-- single log -->
        @foreach(\App\Models\Service::where('level',1)->get() as $service)
        <div class="singleLog flex-column ">
            <h5> {{$service->ar_title}} </h5>
            <h4>{{\App\Models\Order::where('service_id',$service->id)->count()}} </h4>
        </div>
        @endforeach
        <!-- end single log -->
        <!-- single log -->
        <div></div>
        <!-- end single log -->
        <!-- single log -->
        <div class="singleLog flex-column active ">
            <h5> المبيعات </h5>
            <h4> {{\App\Models\Order::sum('total_price')}} </h4>
        </div>
        <!-- end single log -->
        <!-- single log -->
        <div class="singleLog flex-column active ">
            <h5> المبيعات - VAT </h5>
            <h4>  {{(\App\Models\Order::sum('total_price'))-(\App\Models\Order::sum('total_tax'))}} </h4>
        </div>
        <!-- end single log -->
        <!-- single log -->
        <div class="singleLog flex-column active ">
            <h5> عمولة التطبيق </h5>
            <h4> {{\App\Models\Order::sum('commission_value')}}  </h4>
        </div>
        <!-- end single log -->
        <!-- single log -->
        <div class="singleLog flex-column active ">
            <h5> كاش + نقاط بيع </h5>
            <h4> {{(\App\Models\Order::where('payment_method',2)->sum('total_price'))+(\App\Models\Order::where('payment_method',1)->sum('total_price'))}} </h4>
        </div>
        <!-- end single log -->
        <!-- single log -->
        <div class="singleLog flex-column active ">
            <h5> اولاين </h5>
            <h4> {{\App\Models\Order::where('payment_method',3)->sum('total_price')}} </h4>
        </div>
        <!-- end single log -->
        <!-- single log -->
        <div class="singleLog flex-column active ">
            <h5> مستحقات متبقية </h5>
            <h4> {{\App\Models\Order::where('payment_status','no')->sum('total_price')}}</h4>
        </div>
        <!-- end single log -->
        <!-- single log -->
        <div class="singleLog flex-column active ">
            <h5> صافي الربح </h5>
            <h4> {{(\App\Models\Order::sum('total_price'))-(\App\Models\Order::sum('total_tax')-(\App\Models\Order::sum('commission_value')))}}  </h4>
        </div>
        <!-- end single log -->
    </section>
    <div class="d-flex flex-wrap justify-content-end align-items-center ">
        <div class="d-flex flex-wrap justify-content-end ">
            <div class="p-2">
                <button class="btn  exportExcel" onclick="convert()"> Download PDF <i class="fas fa-file-pdf ms-2"></i>
                </button>
            </div>
            <div class="p-2">
                <a href="{{route('admin.export.CarPerformance')}}" class="btn  exportExcel"> <i class="fas fa-download me-2"></i> Export Excel
                </a>
            </div>
        </div>
    </div>
    <section class="drivers">
        <!-- table -->
        <div class="table-rep-plugin">
            <div class="table-responsive mb-0 rounded" data-pattern="priority-columns">
                <table id="datatable" class="table dt-responsive nowrap">
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
                        <th> اسم العميل </th>
                        <th> رقم الجوال </th>
                        <th> الاجمالي </th>
                        <th> العمولة </th>
                        <th> الدفع </th>
                        <th> الحالة </th>
                        <td> </td>
                    </tr>
                    </thead>
                    <tbody>
                 @foreach($orders as $order )

                    <tr>
                        <td> {{$order->id}} </td>
                        <td> {{$order->date}} </td>
                        <td> {{$order->order_time}}</td>
                        <td> {{$order->distributor->full_name??'wash'}} </td>
                        <td> {{$order->number_of_cars??''}} </td>
                        <td> {{$order->service->ar_title??''}} </td>
                        <td> {{$order->sub_service->ar_title??''}} </td>
                        <td>
                        @foreach($order->sub_sub_services as $index=> $service)
                            @if($index==0)
                                    {{$service->ar_title}}
                                @else
                     -       {{$service->ar_title}}

                                @endif
                            @endforeach
                        </td>
                        <td> {{$order->place->ar_name??''}} </td>
                        <td>{{$order->user->full_name??''}}</td>
                        <td> <a href="tel:">{{$order->user->phone_code??''}}{{$order->user->phone??''}}</a> </td>
                        <td> {{$order->total_price}} SR </td>
                        <td> {{$order->commission_value}} SR </td>
                        <td> {{$order->payment->type??''}} </td>

                        <td> <button @if($order->status==5) class="closed" @else class="active" @endif>

                                @if($order->status==1) جديد @elseif($order->status==2) جاري العمل @elseif($order->status==11) السائق بالطريق @elseif($order->status==5) تم الالغاء @elseif($order->status==3) انتهي العمل @elseif($order->status==13) تمت الخدمة  @else لم يحدد   @endif

                            </button> </td>
                        <td>

                        <td>
                            <div class="actionsIcons">
                                <button href="#!" onclick="openEdit()" class="edit" data-toggle="modal" data-target="#edit"> <i class="fas fa-edit"></i> </button>
                            </div>
                        </td>
                    </tr>
                 @endforeach
                    </tbody>
                </table>
                {!! $orders->links() !!}
            </div>
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
                            <textarea class="form-control" rows="5"></textarea>
                        </div>
                        <div class="row">
                            <label class="form-label"> عدد السيارات </label>
                            <div class="col-10 p-2">
                                <input class="form-control" type="number">
                            </div>
                        </div>
                        <div class="row">
                            <label class="form-label"> رصيد المحفظة </label>
                            <div class="col-10 p-2">
                                <input class="form-control" type="text">
                            </div>
                            <div class="col-2 p-2">
                                <button class=" btn mainBtn h-100 w-100"> اضافة </button>
                            </div>
                        </div>
                        <div class="row">
                            <label class="form-label"> مكافاءات فورية </label>
                            <div class="col-10 p-2">
                                <input class="form-control" type="text">
                            </div>
                            <div class="col-2 p-2">
                                <button class=" btn mainBtn h-100 w-100"> اضافة </button>
                            </div>
                        </div>
                        <div class="my-4">
                            <label class="form-label mb-4 "> طريقة الدفع </label>
                            <div class="d-flex align-items-center ">
                                <div class="form-check px-4">
                                    <input class="form-check-input" type="radio" name="pay" id="pay1"
                                           value="option1">
                                    <label class="form-check-label" for="pay1">
                                        كاش
                                    </label>
                                </div>
                                <div class="form-check px-4">
                                    <input class="form-check-input" type="radio" name="pay" id="pay2"
                                           value="option2">
                                    <label class="form-check-label" for="pay2">
                                        Stcpay
                                    </label>
                                </div>
                                <div class="form-check px-4">
                                    <input class="form-check-input" type="radio" name="pay" id="pay3"
                                           value="option3">
                                    <label class="form-check-label" for="pay3">
                                        شبكة
                                    </label>
                                </div>
                                <div class="form-check px-4">
                                    <input class="form-check-input" type="radio" name="pay" id="pay4"
                                           value="option4">
                                    <label class="form-check-label" for="pay4">
                                        تحويل بنكي
                                    </label>
                                </div>
                                <div class="form-check px-4">
                                    <input class="form-check-input" type="radio" name="pay" id="pay5"
                                           value="option5">
                                    <label class="form-check-label" for="pay5">
                                        ابل بي
                                    </label>
                                </div>
                                <div class="form-check px-4">
                                    <input class="form-check-input" type="radio" name="pay" id="pay6"
                                           value="option6">
                                    <label class="form-check-label" for="pay6">
                                        اولاين تطبيقات
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn orangeBtn"> حفظ و إغلاق </button>
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
                                <select class="form-select ">
                                    <option selected disabled> اختر </option>
                                    <option value="1">2021</option>
                                    <option value="2">2020</option>
                                    <option value="3">2019</option>
                                </select>
                            </div>
                            <div class="col-6 p-2">
                                <label class="form-label"> تاريخ الطلب </label>
                                <input class="form-control" type="date">
                            </div>
                            <div class="col-6 p-2">
                                <label class="form-label"> نوع الخدمة </label>
                                <select class="form-select ">
                                    <option selected disabled> اختر </option>
                                    <option value="1">2021</option>
                                    <option value="2">2020</option>
                                    <option value="3">2019</option>
                                </select>
                            </div>
                            <div class="col-6 p-2">
                                <label class="form-label"> رقم الجوال </label>
                                <input class="form-control" type="number">
                            </div>
                            <div class="col-6 p-2">
                                <label class="form-label"> عدد السيارات </label>
                                <input class="form-control" type="number">
                            </div>
                            <div class="col-6 p-2">
                                <label class="form-label"> مكافاءات فورية </label>
                                <input class="form-control" type="text">
                            </div>
                            <div class="col-12 p-2">
                                <label class="form-label"> الاجمالي </label>
                                <input class="form-control" type="text">
                            </div>
                            <div class="col-6 p-2">
                                <label class="form-label mb-4 "> طريقة الدفع </label>
                                <div class="d-flex  flex-column ">
                                    <div class="form-check px-4">
                                        <input class="form-check-input" type="radio" name="pay" id="pay1"
                                               value="option1">
                                        <label class="form-check-label" for="pay1">
                                            كاش
                                        </label>
                                    </div>
                                    <div class="form-check px-4">
                                        <input class="form-check-input" type="radio" name="pay" id="pay2"
                                               value="option2">
                                        <label class="form-check-label" for="pay2">
                                            Stcpay
                                        </label>
                                    </div>
                                    <div class="form-check px-4">
                                        <input class="form-check-input" type="radio" name="pay" id="pay3"
                                               value="option3">
                                        <label class="form-check-label" for="pay3">
                                            شبكة
                                        </label>
                                    </div>
                                    <div class="form-check px-4">
                                        <input class="form-check-input" type="radio" name="pay" id="pay4"
                                               value="option4">
                                        <label class="form-check-label" for="pay4">
                                            تحويل بنكي
                                        </label>
                                    </div>
                                    <div class="form-check px-4">
                                        <input class="form-check-input" type="radio" name="pay" id="pay5"
                                               value="option5">
                                        <label class="form-check-label" for="pay5">
                                            ابل بي
                                        </label>
                                    </div>
                                    <div class="form-check px-4">
                                        <input class="form-check-input" type="radio" name="pay" id="pay6"
                                               value="option6">
                                        <label class="form-check-label" for="pay6">
                                            اولاين تطبيقات
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 p-2">
                                <label class="form-label  mb-4 "> الخدمات الاضافية </label>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" value="" id="service1">
                                    <label class="form-check-label" for="service1">
                                        تلميع مكينة
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" value="" id="service2">
                                    <label class="form-check-label" for="service2">
                                        تلميع جنوط
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" value="" id="service3">
                                    <label class="form-check-label" for="service3">
                                        تعطير السيارة
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" value="" id="service4">
                                    <label class="form-check-label" for="service4">
                                        تلبيس الدعسات
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" value="" id="service5">
                                    <label class="form-check-label" for="service5">
                                        تلميع كرسي أطفال
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn orangeBtn"> حفظ و إغلاق </button>
                </div>
            </div>
        </div>
    </div>




@endsection



@section('js')

   <script>

       function convert(){
           window.print();
       }
   </script>
<script>
    $('#choseMonth').on('keyup keydown change', function(){
        var val = $(this).val();
        var myUrl = "{{route('admin.app.filter.date',':search')}}";
        var string = val;
        myUrl = myUrl.replace(':search',val);
        window.location = myUrl
    });
</script>

<script>
    $('#searchForm').on('submit',function (e){
        e.preventDefault();
        var string = $('#searchInput').val()
        var url = $(this).attr('action');
        var current = window.location.href
        // var paginate='';
        // if (current.includes('?')){
        //     paginate = current.split('?')[1]
        // }

        url = url.replace(':search',string)
        window.location = url
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

            var maxDate = year + '-' + month + '-' + day;
            $('#choseMonth').attr('max', maxDate);
        });

    </script>
<script>
    function openEdit(){
        $('#edit').modal('show');
    }

</script>
@endsection
