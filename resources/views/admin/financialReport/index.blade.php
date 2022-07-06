@extends('admin.layouts.inc.app')

@section('content')

    <!-- date -->
    <div class="d-flex flex-wrap justify-content-end mb-3">
        <div class="p-2">
            <select class="form-select " id="chosestatus">
                <option selected disabled> حالة الطلب </option>
                <option  @isset($status)  @if($status==13) selected  @endif    @endisset  value="13"> مكتملة  </option>
                <option   @isset($status)  @if($status==5) selected  @endif     @endisset  value="5"> ملغية  </option>
                <option   @isset($status)  @if($status==1) selected  @endif    @endisset    value="1"> جديد  </option>
            </select>
        </div>
        <div class="p-2 col-4">
            <input type="date" @isset($date)   value="{{$date}}" @endisset id="choseMonth" class="form-control ">
        </div>

        <div class="p-2">
            <button class="btn  exportExcel"> <i class="fas fa-download me-2"></i> Export Excel
            </button>
        </div>
    </div>


    <div class="apps drivers my-5">
        <h2 class="mb-4"> تطبيق ووش سكواد </h2>
        <div class="table-rep-plugin">
            <div class="table-responsive mb-0 rounded" data-pattern="priority-columns">
                <table id="myTableReport" class="table dt-responsive nowrap">
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
                        <th> السائق </th>
                        <th> الدفع </th>
                        <th> </th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($orders as $order)
                        <tr>

                            <td> {{$order->id}} </td>
                            <td> {{$order->date}} </td>
                            <td> {{$order->order_time}} </td>
                            <td> {{$order->distributor->full_name??'wash'}} </td>
                            <td> {{$order->number_of_cars}} </td>
                            <td> {{$order->service->ar_title ??''}} </td>
                            <td> {{$order->sub_service->ar_title ??''}} </td>
                            <td>

                                @foreach($order->sub_sub_services as $index=> $service)
                                    @if($index==0)
                                        {{$service->ar_title}}
                                    @else
                                        -       {{$service->ar_title}}

                                    @endif
                                @endforeach

                            </td>
                            <td> {{$order->place->ar_name ??''}} </td>
                            <td> {{$order->user->full_name ??''}} </td>
                            <td> <a href="tel:">{{$order->user->phone_code??''}}{{$order->user->phone??''}}</a> </td>
                            <td> {{$order->total_price}}</td>
                            <td> {{$order->driver->full_name??''}} </td>
                            <td> {{$order->payment->type??''}} </td>
                            <td> <button @if($order->status==5) class="closed" @else class="active" @endif>

                                    @if($order->status==1) جديد @elseif($order->status==2) جاري العمل @elseif($order->status==11) السائق بالطريق @elseif($order->status==5) تم الالغاء @elseif($order->status==3) انتهي العمل @elseif($order->status==13) تمت الخدمة  @else لم يحدد   @endif

                                </button> </td>
                        </tr>

                    @endforeach
                    </tbody>
                </table>
                {!! $orders->links() !!}
            </div>
        </div>
    </div>










    <!-- table -->
    @foreach($users as $user)
    <div class="apps drivers my-5">
        <h2 class="mb-4"> تطبيق {{$user->name}} </h2>
        <div class="table-rep-plugin">
            <div class="table-responsive mb-0 rounded" data-pattern="priority-columns">
                <table id="{{$user->id}}" class="table dt-responsive nowrap myTable">
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
                        <th> السائق </th>
                        <th> الدفع </th>
                        <th> </th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($user->distributerOrders as $order)
                    <tr>

                        <td> {{$order->id}} </td>
                        <td> {{$order->date}} </td>
                        <td> {{$order->order_time}} </td>
                        <td> {{$order->distributor->full_name??'wash'}} </td>
                        <td> {{$order->number_of_cars}} </td>
                        <td> {{$order->service->ar_title ??''}} </td>
                        <td> {{$order->sub_service->ar_title ??''}} </td>
                        <td>

                            @foreach($order->sub_sub_services as $index=> $service)
                                @if($index==0)
                                    {{$service->ar_title}}
                                @else
                                    -       {{$service->ar_title}}

                                @endif
                            @endforeach

                        </td>
                        <td> {{$order->place->ar_name ??''}} </td>
                        <td> {{$order->user->full_name ??''}} </td>
                        <td> <a href="tel:">{{$order->user->phone_code??''}}{{$order->user->phone??''}}</a> </td>
                        <td> {{$order->total_price}}</td>
                        <td> {{$order->driver->full_name??''}} </td>
                        <td> {{$order->payment->type??''}} </td>
                        <td> <button @if($order->status==5) class="closed" @else class="active" @endif>

                                @if($order->status==1) جديد @elseif($order->status==2) جاري العمل @elseif($order->status==11) السائق بالطريق @elseif($order->status==5) تم الالغاء @elseif($order->status==3) انتهي العمل @elseif($order->status==13) تمت الخدمة  @else لم يحدد   @endif

                            </button> </td>
                    </tr>
                    @empty
                        <tr >
                           <td colspan="15">
                               لايوجد طلبات لهذا التطبيق
                           </td>
                        </tr>
                    @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endforeach

@endsection


@section('js')

    <script>

        $('#choseMonth').on('keyup keydown change', function(){
            var val = $(this).val();
            var myUrl = "{{route('admin.financialOrderReport.searchByDate',':search')}}";
            var string = val;
            myUrl = myUrl.replace(':search',val);
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

        var maxDate = year + '-' + month + '-' + day;
        $('#choseMonth').attr('max', maxDate);
    });
</script>

    <script>

        $('#chosestatus').on('keyup keydown change', function(){
            var val = $(this).val();
            var myUrl = "{{route('admin.financialOrderReport.searchByOrderStatus',':search')}}";
            var string = val;
            myUrl = myUrl.replace(':search',val);
            window.location = myUrl
        });
    </script>
        <!-- Required datatable js -->
        <script src="{{url('assets/admin')}}/libs/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="{{url('assets/admin')}}/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
        <!-- Buttons examples -->
        <script src="{{url('assets/admin')}}/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
        <script src="{{url('assets/admin')}}/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
        <script src="{{url('assets/admin')}}/libs/jszip/jszip.min.js"></script>
        <script src="{{url('assets/admin')}}/libs/pdfmake/build/pdfmake.min.js"></script>
        <script src="{{url('assets/admin')}}/libs/pdfmake/build/vfs_fonts.js"></script>
        <script src="{{url('assets/admin')}}/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
        <script src="{{url('assets/admin')}}/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
        <script src="{{url('assets/admin')}}/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>
        <!-- Responsive examples -->
        <script src="{{url('assets/admin')}}/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="{{url('assets/admin')}}/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
        <!-- Datatable init js -->
        <script src="{{url('assets/admin')}}/js/pages/datatables.init.js"></script>
<script>
    myTableReport

    $(document).ready( function () {
        $("#myTableReport").DataTable({


            buttons: [ 'copy', 'excel', 'pdf', 'colvis' ],
            dom: 'Bfrtip',
            "bPaginate": false,
            language:{
                "decimal":        "",
                "emptyTable":     "لا يوجد بيانات ف الجدول",
                "info":           "اظهار_START_الي_END_من_TOTAL_صفوف",
                "infoEmpty":      "اظهار 0 الي 0 من 0 صفوف",
                "infoFiltered":   "(بحث من _MAX_صفوف)",
                "infoPostFix":    "",
                "thousands":      ",",
                "lengthMenu":     "Show _MENU_ entries",
                "loadingRecords": "تحميل...",
                "processing":     "",
                "search":         "بحث:",
                "zeroRecords":    "لا يوجد بيانات",
                "paginate": {
                    "first":      "الاول",
                    "last":       "الاخير",
                    "next":       "التالي",
                    "previous":   "السابق"
                }}



        });
    } );





@foreach($users as $user)
    $(document).ready( function () {
        $("#{{$user->id}}").DataTable({


            buttons: [ 'copy', 'excel', 'pdf', 'colvis' ],
            dom: 'Bfrtip',
                "bPaginate": true,
                language:{
    "decimal":        "",
    "emptyTable":     "لا يوجد بيانات ف الجدول",
    "info":           "اظهار_START_الي_END_من_TOTAL_صفوف",
    "infoEmpty":      "اظهار 0 الي 0 من 0 صفوف",
    "infoFiltered":   "(بحث من _MAX_صفوف)",
    "infoPostFix":    "",
    "thousands":      ",",
    "lengthMenu":     "Show _MENU_ entries",
    "loadingRecords": "تحميل...",
    "processing":     "",
    "search":         "بحث:",
    "zeroRecords":    "لا يوجد بيانات",
    "paginate": {
        "first":      "الاول",
        "last":       "الاخير",
        "next":       "التالي",
        "previous":   "السابق"
    }}



    });
    } );
@endforeach

</script>
<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>


@endsection


@section('style')

    <link href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />

@endsection
