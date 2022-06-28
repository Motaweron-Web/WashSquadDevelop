@extends('admin.layouts.inc.app')

@section('content')


    <!-- date -->
    <div class="d-flex flex-wrap justify-content-end mb-3">
        <form class="col-md-4" id="searchForm" action="{{route('admin.carPerformance.search',":search")}}">

        <div class="p-2 col-md-9">
            <input type="search" @isset($search) value="{{$search}}"   @endisset name="search" id="searchInput" class="form-control "
                   placeholder="phone number - order number">
        </div>
        </form>
        <div class="p-2 col-4">
            <input type="date" @isset($date)  value="{{$date}}"  @endisset id="choseMonth" class="form-control ">
        </div>
        <div class="p-2">
            <select id="choseCar"  class="form-select shadow-lg">
                <option selected disabled > السيارة  </option>
                @foreach(\App\Models\User::where('user_type',2)->get() as $driver)
                <option value="{{$driver->id}}" @isset($car)   @if($car==$driver)  selected   @endif   @endisset> {{$driver->name}} </option>
                @endforeach
            </select>
        </div>
        <div class="p-2">
            <a href="{{route('admin.export.CarPerformance')}}" class="btn  exportExcel"> <i class="fas fa-download me-2"></i> Export Excel
            </a>
        </div>
    </div>
    <!-- table -->
    <div class="apps drivers">
        <div class="table-rep-plugin">
            <div class="table-responsive mb-0 rounded" data-pattern="priority-columns">
                <table id="datatable" class="table dt-responsive nowrap">
                    <thead>
                    <tr>
                        <th> كود  </th>
                        <th> رقم الطلب </th>
                        <th> المبلغ </th>
                        <th> نوع  <br> الخدمة </th>
                        <th> جوال  العميل </th>
                        <th> حالة  الطلب </th>
                        <th> تاريخ/وقت  إرسال الطلب </th>
                        <th> وقت الذهاب  للعميل </th>
                        <th> وقت  الوصول </th>
                        <th> وقت بداية  العمل </th>
                        <th> وقت الإنتهاء  من العمل </th>
                        <th> وقت تمت  الخدمة </th>
                        <th> مدة  الطريق </th>
                        <th> مدة  العمل </th>
                        <th> مدة  الطلب كامل </th>
                        <th> تقييم  الطلب </th>
                        <th> ملاحظات  العميل </th>
                    </tr>
                    </thead>
                    <tbody>
                    @isset($orders)
                    @foreach($orders as $order)
                    <tr>
                        <td> {{$order->driver->id ?? ''}} </td>
                        <td> {{$order->id}}</td>
                        <td> {{$order->total_price}} </td>
                        <td> {{$order->service->ar_title ?? ''}} </td>
                        <td> <a href="tel:">{{$order->user->phone_code}}{{$order->user->phone}}</a> </td>
                        <td> <button @if($order->status==5) class="closed" @else class="active" @endif>

                                @if($order->status==1) جديد @elseif($order->status==2) جاري العمل @elseif($order->status==11) السائق بالطريق @elseif($order->status==5) تم الالغاء @elseif($order->status==3) انتهي العمل @elseif($order->status==13) تمت الخدمة  @else لم يحدد   @endif

                            </button> </td>
                        <td>
                            <date class="d-block"> {{$order->date}}</date>
                            <time class="d-block"> {{$order->order_time}} </time>
                        </td>
                        <td> {{$order->go}} </td>
                        <td> {{$order->arrive_time}} </td>
                        <td> {{$order->start_date}} </td>
                        <td> {{$order->finsh_date}} </td>
                        <td> {{$order->done_date}} </td>
                        <td> {{$order->road_time}} min </td>
                        <td> {{$order->timer}} min</td>
                        <td>{{$order->full_order_time}} min </td>
                        <td> <span> {{$order->rating}}X </span> <i class="fas fa-star"></i> </td>
                        <td> {{$order->notes}}</td>
                    </tr>
                    @endforeach
                    @endisset


                    @isset($ordersByMobile)
                        @foreach($ordersByMobile as $order)
                            <tr>
                                <td> {{$order->driver->id ?? ''}} </td>
                                <td> {{$order->id}}</td>
                                <td> {{$order->total_price}} </td>
                                <td> {{$order->service->ar_title ?? ''}} </td>
                                <td> <a href="tel:">{{$order->user->phone_code}}{{$order->user->phone}}</a> </td>
                                <td> <button @if($order->status==5) class="closed" @else class="active" @endif>

                                        @if($order->status==1) جديد @elseif($order->status==2) جاري العمل @elseif($order->status==11) السائق بالطريق @elseif($order->status==5) تم الالغاء @elseif($order->status==3) انتهي العمل @elseif($order->status==13) تمت الخدمة  @else لم يحدد   @endif

                                    </button> </td>
                                <td>                                <td>
                                    <date class="d-block"> {{$order->date}}</date>
                                    <time class="d-block"> {{$order->order_time}} </time>
                                </td>
                                <td> {{$order->go}} </td>
                                <td> {{$order->arrive_time}} </td>
                                <td> {{$order->start_date}} </td>
                                <td> {{$order->finsh_date}} </td>
                                <td> {{$order->done_date}} </td>
                                <td> {{$order->road_time}} min </td>
                                <td> {{$order->timer}} min</td>
                                <td>{{$order->full_order_time}} min </td>
                                <td> <span> {{$order->rating}}X </span> <i class="fas fa-star"></i> </td>
                                <td> {{$order->notes}}</td>
                            </tr>
                        @endforeach
                    @endisset

                    @isset($ordersById)
                        @foreach($ordersById as $order)
                            <tr>
                                <td> {{$order->driver->id ?? ''}} </td>
                                <td> {{$order->id}}</td>
                                <td> {{$order->total_price}} </td>
                                <td> {{$order->service->ar_title ?? ''}} </td>
                                <td> <a href="tel:">{{$order->user->phone_code}}{{$order->user->phone}}</a> </td>
                                <td> <button @if($order->status==5) class="closed" @else class="active" @endif>

                                        @if($order->status==1) جديد @elseif($order->status==2) جاري العمل @elseif($order->status==11) السائق بالطريق @elseif($order->status==5) تم الالغاء @elseif($order->status==3) انتهي العمل @elseif($order->status==13) تمت الخدمة  @else لم يحدد   @endif

                                    </button> </td>
                                <td>                                <td>
                                    <date class="d-block"> {{$order->date}}</date>
                                    <time class="d-block"> {{$order->order_time}} </time>
                                </td>
                                <td> {{$order->go}} </td>
                                <td> {{$order->arrive_time}} </td>
                                <td> {{$order->start_date}} </td>
                                <td> {{$order->finsh_date}} </td>
                                <td> {{$order->done_date}} </td>
                                <td> {{$order->road_time}} min </td>
                                <td> {{$order->timer}} min</td>
                                <td>{{$order->full_order_time}} min </td>
                                <td> <span> {{$order->rating}}X </span> <i class="fas fa-star"></i> </td>
                                <td> {{$order->notes}}</td>
                            </tr>
                        @endforeach
                    @endisset




                    </tbody>
                </table>
                @if(isset($orders))

                    {!! $orders->links() !!}

                @elseif(isset($ordersById))
                    {!! $ordersById->links() !!}
                @elseif(isset($ordersByMobile))

                    {!! $ordersByMobile->links() !!}



                @endif

            </div>
        </div>
    </div>





@endsection

@section('style')



@endsection

@section('js')
<script>
    $('#choseMonth').on('keyup keydown change', function(){
        var val = $(this).val();
        var myUrl = "{{route('admin.carPerformance.searchByDate',':search')}}";
        var string = val;
        myUrl = myUrl.replace(':search',val);
        window.location = myUrl
    });
    $('#searchForm').on('submit',function (e){
        e.preventDefault();
        var string = $('#searchInput').val()
        var url = $(this).attr('action')
        var current = window.location.href
        // var paginate='';
        // if (current.includes('?')){
        //     paginate = current.split('?')[1]
        // }

        url = url.replace(':search',string)
        window.location = url
    })
    $('#choseCar').on('keyup keydown change', function(){
        var val = $(this).val();
        var myUrl = "{{route('admin.carPerformance.searchByCar',':car')}}";
        var string = val;
        myUrl = myUrl.replace(':car',val);
        window.location = myUrl
        window.location = myUrl
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
