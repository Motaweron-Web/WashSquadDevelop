@extends('admin.layouts.inc.app')
@section('class')
    apps operation burn
@endsection
@section('cont')
    <style>
        #map {
            height: 100%;
        }

        /*
         * Optional: Makes the sample page fill the window.
         */
        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
        }


    </style>

    <!-- date -->
    <div class="main-content">
        <div class="page-content apps operation burn">
            <div class="container-fluid">


    <div class="d-flex flex-wrap justify-content-end mb-3">
        <div class="p-2 col-4">

            <form method="get" action="{{route('searcbymobile')}}">
                <div class="row">
                    <div class="col-md-8">
            <input type="search"  name="search" @isset($search)  value="{{$search}}"    @endisset class="form-control searchInput"
                   placeholder="phone number .. order number">
                    </div>
                    <div class="col-md-2">
                <button class="btn btn-info" type="submit">بحث </button>
                    </div>
                </div>
        </form>

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
                <input type="month" class="form-control"  id="choseMonth" value="{{$request->month}}">

            </div>
            <div class="p-2">
                <button onclick="convert()" class="btn  exportExcel"> <i class="fas fa-download me-2"></i> Export PDF
                </button>
            </div>
        </div>
    </div>
    <!-- Map -->
    <div class="gps">
        <h4 class="operation-head"> خريطة الطلبات </h4>
        <div  width="100%" height="300px" style="border:0;">
            <div id="mapId" style="position:unset !important"></div>
        </div>

    </div>
    <!-- count -->
    <div class="row">
        <div class="col-lg-2 col-md-4 col-sm-6 px-1  mb-2 ">
            <div class="cols-divs purble">
                <h5 class="text-white"> طلبات جديدة <i class="fas fa-mobile-alt px-1"></i> </h5>
                <span>{{App\Models\Order::where('status',1)->count()}}</span>
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6 px-1  mb-2 ">
            <div class="cols-divs yelo">
                <h5 class="text-white"> السائق بالطريق <i class="fas fa-car-alt px-1"></i> </h5>
                <span>{{App\Models\Order::where('status',11)->count()}}</span>
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6 px-1  mb-2 ">
            <div class="cols-divs blu">
                <h5 class="text-white"> جاري العمل <i class="fas fa-cloud-moon px-1"></i> </h5>
                <span>{{App\Models\Order::where('status',2)->count()}}</span>
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6 px-1  mb-2 ">
            <div class="cols-divs gry">
                <h5 class="text-white"> إنتهى العمل <i class="far fa-clock px-1"></i> </h5>
                <span>{{App\Models\Order::where('status',3)->count()}}</span>
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6 px-1  mb-2 ">
            <div class="cols-divs gren">
                <h5 class="text-white"> تمت الخدمة <i class="fas fa-mobile-alt px-1 "></i> </h5>
                <span>{{App\Models\Order::where('status',13)->count()}}</span>
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6 px-1  mb-2 ">
            <div class="cols-divs rd">
                <h5 class="text-white"> طلبات ملغية <i class="far fa-times-circle px-1"></i> </h5>
                <span>{{App\Models\Order::where('status',5)->count()}}</span>
            </div>
        </div>
    </div>
    <!-- table -->
    <div class="table-rep-plugin">
        <div class="table-responsive mb-0 rounded" data-pattern="priority-columns">
            <table id="datatable-buttons" class="table  nowrap">
                <thead>
                <tr>
                    <th> رقم الطلب </th>
                    <th> تاريخ الطلب </th>
                    <th> الوقت </th>
                    <th> المزود </th>
                    <th> العدد </th>
                    <th> نوع الخدمة </th>
                    <th> الباقة </th>
                    <th> خدمة إضافة </th>
                    <th> الحي </th>
                    <th> إسم العميل </th>
                    <th>  لوحة السيارة </th>
                    <th>   الحالة </th>

                    <th> رقم الجوال </th>
                    <th> الماركة </th>
                    <th> الإجمالي </th>
                    <th> السائق </th>
                    <th> الموقع </th>
                    <th> فاتورة </th>
                    <th> إعدادات </th>
                </tr>
                </thead>
                <tbody>
                @isset($neworders)
                @foreach($neworders as $order)
                    @php

                        $firstSubServiceTitle = '';
                        $subServiceOrder = App\Models\SubServiceOrder::where('order_id',$order->id)->with('service');
                        if($subServiceOrder->count()){
                                $firstSubServiceTitle = $subServiceOrder->get()[0]->service->ar_title;
                        }
                    @endphp
                <tr id="{{$order->id}}" class="purble big-border-p text-white">
                    <td> {{$order->id}}</td>
                    <td> {{$order->date}}</td>
                    <td> {{$order->order_time}}</td>
                    <td> {{$order->service->ar_title}}</td>
                    <td> {{$order->number_of_cars}}</td>
                    <td>{{$order->service_basic->ar_title??''}}</td>
                    <td>{{$order->service_basic->ar_title??''}}</td>
                    <td>{{$firstSubServiceTitle}}</td>
                    <td> {{$order->place->ar_name??''}}</td>
                    <td>{{$order->user->full_name??''}}</td>
                    <td>{{$order->car_blade_number}}</td>
                    <td>جديد</td>

                    <td> {{$order->user->phone_code??''}}{{$order->user->phone??''}}</td>
                    <td>{{$order->type->ar_title??''}}</td>
                    <td>{{$order->total_price??0}}</td>
                    <td>
                        <select class="form-select chooseDriver"  orderid="{{$order->id}}" data-id="{{$order->id}}" >
                            <option value=""  disabled> إختر السائق</option>
                            @foreach($drivers as $driver)
                                <option value="{{$driver->id}}" {{$driver->id == $order->driver_id?'selected':''}}>{{$driver->name}}</option>
                            @endforeach
                        </select>
                    </td>
                    <td><a href="https://maps.google.com/?q={{$order->latitude}},{{$order->longitude}}" target="_blank"> <i class="fas fa-map-marker-alt"></i>
                        </a></td>
                    <td><a href="{{url("api/order/print/$order->id")}}" target="_blank"><i class="fas fa-file-pdf"></i> </a></td>
                    <td>
                        <a data-bs-toggle="modal" data-bs-target="#exampleModal" orderid="{{$order->id}}" class="showdetails"
                           style="cursor: pointer;"> <i class="dripicons-information px-1 informationData"></i>
                        </a>

                        <a data-bs-toggle="modal" data-bs-target="#exampleModal2" class="editorder"  orderid="{{$order->id}}"
                           style="cursor: pointer;"> <i class="far fa-edit px-1 editOrder"></i>
                        </a>



                        <a  class="deleteorder" orderid="{{$order->id}}"
                            style="cursor: pointer;"> <i class="far fa-trash-alt  px-1 deleteBtn"></i>
                        </a>                        </td>
                </tr>
                @endforeach
                @endisset
                @isset($doneorders)
                @foreach($doneorders as $order)
                    @php

                        $firstSubServiceTitle = '';
                        $subServiceOrder = App\Models\SubServiceOrder::where('order_id',$order->id)->with('service');
                        if($subServiceOrder->count()){
                                $firstSubServiceTitle = $subServiceOrder->get()[0]->service->ar_title;
                        }
                    @endphp
                <tr  id="{{$order->id}}" class="gry big-border-p text-white">
                    <td> {{$order->id}}</td>
                    <td> {{$order->date}}</td>
                    <td> {{$order->order_time}}</td>
                    <td> {{$order->service->ar_title}}</td>
                    <td> {{$order->number_of_cars}}</td>
                    <td>{{$order->service_basic->ar_title??''}}</td>
                    <td>{{$order->service_basic->ar_title??''}}</td>
                    <td>{{$firstSubServiceTitle}}</td>
                    <td> {{$order->place->ar_name??''}}</td>
                    <td>{{$order->user->full_name??''}}</td>
                    <td>{{$order->car_blade_number}}</td>
                    <td>انتهي العمل</td>

                    <td> {{$order->user->phone_code??''}}{{$order->user->phone??''}}</td>
                    <td>{{$order->type->ar_title??''}}</td>
                    <td>{{$order->total_price??0}}</td>
                    <td>
                        <select class="form-select chooseDriver"  orderid="{{$order->id}}" data-id="{{$order->id}}">
                            <option value="" selected disabled> إختر السائق</option>
                            @foreach($drivers as $driver)
                                <option value="{{$driver->id}}" {{$driver->id == $order->driver_id?'selected':''}}>{{$driver->name}}</option>
                            @endforeach
                        </select>
                    </td>
                    <td><a href="https://maps.google.com/?q={{$order->latitude}},{{$order->longitude}}" target="_blank"> <i class="fas fa-map-marker-alt"></i>
                        </a></td>
                    <td><a href="{{url("api/order/print/$order->id")}}" target="_blank"><i class="fas fa-file-pdf"></i> </a></td>
                    <td>
                        <a data-bs-toggle="modal" data-bs-target="#exampleModal" orderid="{{$order->id}}" class="showdetails"
                           style="cursor: pointer;"> <i class="dripicons-information px-1 informationData"></i>
                        </a>

                        <a data-bs-toggle="modal" data-bs-target="#exampleModal2" class="editorder"  orderid="{{$order->id}}"
                           style="cursor: pointer;"> <i class="far fa-edit px-1 editOrder"></i>
                        </a>



                        <a  class="deleteorder" orderid="{{$order->id}}"
                            style="cursor: pointer;"> <i class="far fa-trash-alt  px-1 deleteBtn"></i>
                        </a>                        </td>
                </tr>
                @endforeach
                @endisset
                @isset($roadorders)
                @foreach($roadorders as $order)
                    @php

                        $firstSubServiceTitle = '';
                        $subServiceOrder = App\Models\SubServiceOrder::where('order_id',$order->id)->with('service');
                        if($subServiceOrder->count()){
                                $firstSubServiceTitle = $subServiceOrder->get()[0]->service->ar_title;
                        }
                    @endphp
                    <tr id="{{$order->id}}" class="yelo big-border-p text-white">
                        <td> {{$order->id}}</td>
                        <td> {{$order->date}}</td>
                        <td> {{$order->order_time}}</td>
                        <td> {{$order->service->ar_title}}</td>
                        <td> {{$order->number_of_cars}}</td>
                        <td>{{$order->service_basic->ar_title??''}}</td>
                        <td>{{$order->service_basic->ar_title??''}}</td>
                        <td>{{$firstSubServiceTitle}}</td>
                        <td> {{$order->place->ar_name??''}}</td>
                        <td>{{$order->user->full_name??''}}</td>
                        <td>{{$order->car_blade_number}}</td>
                        <td>السائق بالطريق</td>

                        <td> {{$order->user->phone_code??''}}{{$order->user->phone??''}}</td>
                        <td>{{$order->type->ar_title??''}}</td>
                        <td>{{$order->total_price??0}}</td>
                        <td>
                            <select class="form-select chooseDriver"  orderid="{{$order->id}}" data-id="{{$order->id}}">
                                <option value="" selected disabled> إختر السائق</option>
                                @foreach($drivers as $driver)
                                    <option value="{{$driver->id}}" {{$driver->id == $order->driver_id?'selected':''}}>{{$driver->name}}</option>
                                @endforeach
                            </select>
                        </td>
                        <td><a href="https://maps.google.com/?q={{$order->latitude}},{{$order->longitude}}" target="_blank"> <i class="fas fa-map-marker-alt"></i>
                            </a></td>
                        <td><a href="{{url("api/order/print/$order->id")}}" target="_blank"><i class="fas fa-file-pdf"></i> </a></td>
                        <td>
                            <a data-bs-toggle="modal" data-bs-target="#exampleModal" orderid="{{$order->id}}" class="showdetails"
                               style="cursor: pointer;"> <i class="dripicons-information px-1 informationData"></i>
                            </a>

                            <a data-bs-toggle="modal" data-bs-target="#exampleModal2"  class="editorder"  orderid="{{$order->id}}"
                               style="cursor: pointer;"> <i class="far fa-edit px-1 editOrder"></i>
                            </a>



                            <a  class="deleteorder" orderid="{{$order->id}}"
                                style="cursor: pointer;"> <i class="far fa-trash-alt  px-1 deleteBtn"></i>
                            </a>                        </td>
                    </tr>
                @endforeach
                @endisset

                @isset($workorders)

                    @foreach($workorders as $order)
                    @php

                        $firstSubServiceTitle = '';
                        $subServiceOrder = App\Models\SubServiceOrder::where('order_id',$order->id)->with('service');
                        if($subServiceOrder->count()){
                                $firstSubServiceTitle = $subServiceOrder->get()[0]->service->ar_title;
                        }
                    @endphp
                    <tr id="{{$order->id}}" class="blu big-border-p text-white">
                        <td> {{$order->id}}</td>
                        <td> {{$order->date}}</td>
                        <td> {{$order->order_time}}</td>
                        <td> {{$order->service->ar_title}}</td>
                        <td> {{$order->number_of_cars}}</td>
                        <td>{{$order->service_basic->ar_title??''}}</td>
                        <td>{{$order->service_basic->ar_title??''}}</td>
                        <td>{{$firstSubServiceTitle}}</td>
                        <td> {{$order->place->ar_name??''}}</td>
                        <td>{{$order->user->full_name??''}}</td>
                        <td>{{$order->car_blade_number}}</td>
                        <td>جاري العمل</td>

                        <td> {{$order->user->phone_code??''}}{{$order->user->phone??''}}</td>
                        <td>{{$order->type->ar_title??''}}</td>
                        <td>{{$order->total_price??0}}</td>
                        <td>
                            <select class="form-select chooseDriver"  orderid="{{$order->id}}" id="" data-id="{{$order->id}}">
                                <option value="" selected disabled> إختر السائق</option>
                                @foreach($drivers as $driver)
                                    <option value="{{$driver->id}}" {{$driver->id == $order->driver_id?'selected':''}}>{{$driver->name}}</option>
                                @endforeach
                            </select>
                        </td>
                        <td><a href="https://maps.google.com/?q={{$order->latitude}},{{$order->longitude}}" target="_blank"> <i class="fas fa-map-marker-alt"></i>
                            </a></td>
                        <td><a href="{{url("api/order/print/$order->id")}}" target="_blank"><i class="fas fa-file-pdf"></i> </a></td>
                        <td>
                            <a data-bs-toggle="modal" data-bs-target="#exampleModal" orderid="{{$order->id}}" class="showdetails"
                               style="cursor: pointer;"> <i class="dripicons-information px-1 informationData"></i>
                            </a>

                            <a data-bs-toggle="modal" data-bs-target="#exampleModal2" class="editorder"  orderid="{{$order->id}}"
                               style="cursor: pointer;"> <i class="far fa-edit px-1 editOrder"></i>
                            </a>



                            <a  class="deleteorder" orderid="{{$order->id}}"
                                style="cursor: pointer;"> <i class="far fa-trash-alt  px-1 deleteBtn"></i>
                            </a>                        </td>
                    </tr>
                @endforeach
                @endisset


                    @isset($finishorders)
                        @foreach($finishorders as $order)
                    @php

                        $firstSubServiceTitle = '';
                        $subServiceOrder = App\Models\SubServiceOrder::where('order_id',$order->id)->with('service');
                        if($subServiceOrder->count()){
                                $firstSubServiceTitle = $subServiceOrder->get()[0]->service->ar_title;
                        }
                    @endphp
                    <tr id="{{$order->id}}" class="gren big-border-p text-white">
                        <td> {{$order->id}}</td>
                        <td> {{$order->date}}</td>
                        <td> {{$order->order_time}}</td>
                        <td> {{$order->service->ar_title}}</td>
                        <td> {{$order->number_of_cars}}</td>
                        <td>{{$order->service_basic->ar_title??''}}</td>
                        <td>{{$order->service_basic->ar_title??''}}</td>
                        <td>{{$firstSubServiceTitle}}</td>
                        <td> {{$order->place->ar_name??''}}</td>
                        <td>{{$order->user->full_name??''}}</td>
                        <td>{{$order->car_blade_number}}</td>
                        <td>تمت الخدمة</td>

                        <td> {{$order->user->phone_code??''}}{{$order->user->phone??''}}</td>
                        <td>{{$order->type->ar_title??''}}</td>
                        <td>{{$order->total_price??0}}</td>
                        <td>
                            <select class="form-select chooseDriver"   orderid="{{$order->id}}" data-id="{{$order->id}}">
                                <option value="" selected disabled> إختر السائق</option>
                                @foreach($drivers as $driver)
                                    <option value="{{$driver->id}}" {{$driver->id == $order->driver_id?'selected':''}}>{{$driver->name}}</option>
                                @endforeach
                            </select>
                        </td>
                        <td><a href="https://maps.google.com/?q={{$order->latitude}},{{$order->longitude}}" target="_blank"> <i class="fas fa-map-marker-alt"></i>
                            </a></td>
                        <td><a href="{{url("api/order/print/$order->id")}}" target="_blank"><i class="fas fa-file-pdf"></i> </a></td>
                        <td>
                            <a data-bs-toggle="modal" data-bs-target="#exampleModal" orderid="{{$order->id}}" class="showdetails"
                               style="cursor: pointer;"> <i class="dripicons-information px-1 informationData"></i>
                            </a>

                            <a data-bs-toggle="modal" data-bs-target="#exampleModal2" class="editorder" orderid="{{$order->id}}"
                               style="cursor: pointer;"> <i class="far fa-edit px-1 editOrder"></i>
                            </a>



                            <a  class="deleteorder" orderid="{{$order->id}}"
                                style="cursor: pointer;"> <i class="far fa-trash-alt  px-1 deleteBtn"></i>
                            </a>                        </td>
                    </tr>
                @endforeach
                    @endisset
                @isset($cancelorders)
                @foreach($cancelorders as $order)
                    @php

                        $firstSubServiceTitle = '';
                        $subServiceOrder = App\Models\SubServiceOrder::where('order_id',$order->id)->with('service');
                        if($subServiceOrder->count()){
                                $firstSubServiceTitle = $subServiceOrder->get()[0]->service->ar_title;
                        }
                    @endphp
                    <tr id="{{$order->id}}" class="rd big-border-p text-white">
                        <td> {{$order->id}}</td>
                        <td> {{$order->date}}</td>
                        <td> {{$order->order_time}}</td>
                        <td> {{$order->service->ar_title}}</td>
                        <td> {{$order->number_of_cars}}</td>
                        <td>{{$order->service_basic->ar_title??''}}</td>
                        <td>{{$order->service_basic->ar_title??''}}</td>
                        <td>{{$firstSubServiceTitle}}</td>
                        <td> {{$order->place->ar_name??''}}</td>
                        <td>{{$order->user->full_name??''}}</td>
                        <td>{{$order->car_blade_number}}</td>
                        <td> تم الالغاء</td>

                        <td> {{$order->user->phone_code??''}}{{$order->user->phone??''}}</td>
                        <td>{{$order->type->ar_title??''}}</td>
                        <td>{{$order->total_price??0}}</td>
                        <td>
                            <select class="form-select chooseDriver"  orderid="{{$order->id}}" id="target" data-id="{{$order->id}}">
                                <option value="" selected disabled> إختر السائق</option>
                                @foreach($drivers as $driver)
                                    <option value="{{$driver->id}}" {{$driver->id == $order->driver_id?'selected':''}}>{{$driver->name}}</option>
                                @endforeach
                            </select>
                        </td>
                        <td><a href="https://maps.google.com/?q={{$order->latitude}},{{$order->longitude}}" target="_blank"> <i class="fas fa-map-marker-alt"></i>
                            </a></td>
                        <td><a href="{{url("api/order/print/$order->id")}}" target="_blank"><i class="fas fa-file-pdf"></i> </a></td>
                        <td>
                            <a data-bs-toggle="modal" data-bs-target="#exampleModal" orderid="{{$order->id}}" class="showdetails"
                               style="cursor: pointer;"> <i class="dripicons-information px-1 informationData"></i>
                            </a>

                            <a data-bs-toggle="modal" data-bs-target="#exampleModal2" class="editorder"  orderid="{{$order->id}}"
                               style="cursor: pointer;"> <i class="far fa-edit px-1 editOrder"></i>
                            </a>



                            <a  class="deleteorder" orderid="{{$order->id}}"
                               style="cursor: pointer;"> <i class="far fa-trash-alt  px-1 deleteBtn"></i>
                            </a>                        </td>
                    </tr>
                @endforeach
                @endisset



                @isset($searchordersbymobile)

                    @foreach($searchordersbymobile as $order)
                        @php

                            $firstSubServiceTitle = '';
                            $subServiceOrder = App\Models\SubServiceOrder::where('order_id',$order->id)->with('service');
                            if($subServiceOrder->count()){
                                    $firstSubServiceTitle = $subServiceOrder->get()[0]->service->ar_title;
                            }
                        @endphp
                        <tr id="{{$order->id}}" @if($order->status==1) class="purble big-border-p text-white" @elseif($order->status==2) class="blu big-border-p text-white" @elseif($order->status==11) class="yelo big-border-p text-white" @elseif($order->status==5) class="rd big-border-p text-white" @elseif($order->status==3) class="gry big-border-p text-white" @elseif($order->status==13) class="gren big-border-p text-white" @endif>
                            <td> {{$order->id}}</td>
                            <td> {{$order->date}}</td>
                            <td> {{$order->order_time}}</td>
                            <td> {{$order->service->ar_title}}</td>
                            <td> {{$order->number_of_cars}}</td>
                            <td>{{$order->service_basic->ar_title??''}}</td>
                            <td>{{$order->service_basic->ar_title??''}}</td>
                            <td>{{$firstSubServiceTitle}}</td>
                            <td> {{$order->place->ar_name??''}}</td>
                            <td>{{$order->user->full_name??''}}</td>
                            <td>{{$order->car_blade_number}}</td>
                            <td>
                        @if($order->status==1) جديد @elseif($order->status==2) جاري العمل @elseif($order->status==11) السائق بالطريق @elseif($order->status==5) تم الالغاء @elseif($order->status==3) انتهي العمل @elseif($order->status==13) تمت الخدمة @endif


                        </td>

                            <td> {{$order->user->phone_code??''}}{{$order->user->phone??''}}</td>
                            <td>{{$order->type->ar_title??''}}</td>
                            <td>{{$order->total_price??0}}</td>
                            <td>
                                <select class="form-select chooseDriver"  orderid="{{$order->id}}" id="target" data-id="{{$order->id}}">
                                    <option value="" selected disabled> إختر السائق</option>
                                    @foreach($drivers as $driver)
                                        <option value="{{$driver->id}}" @if($driver->id == $order->driver_id)selected @endif>{{$driver->name}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td><a href="https://maps.google.com/?q={{$order->latitude}},{{$order->longitude}}" target="_blank"> <i class="fas fa-map-marker-alt"></i>
                                </a></td>
                            <td><a href="{{url("api/order/print/$order->id")}}" target="_blank"><i class="fas fa-file-pdf"></i> </a></td>
                            <td>
                                <a data-bs-toggle="modal" data-bs-target="#exampleModal" orderid="{{$order->id}}" class="showdetails"
                                   style="cursor: pointer;"> <i class="dripicons-information px-1 informationData"></i>
                                </a>

                                <a data-bs-toggle="modal" data-bs-target="#exampleModal2" class="editorder" orderid="{{$order->id}}"
                                   style="cursor: pointer;"> <i class="far fa-edit px-1 editOrder"></i>
                                </a>



                                <a  class="deleteorder" orderid="{{$order->id}}"
                                    style="cursor: pointer;"> <i class="far fa-trash-alt  px-1 deleteBtn"></i>
                                </a>                        </td>
                        </tr>
                    @endforeach

                @endisset




                @isset($searchorders)

                    @foreach($searchorders as $order)
                        @php

                            $firstSubServiceTitle = '';
                            $subServiceOrder = App\Models\SubServiceOrder::where('order_id',$order->id)->with('service');
                            if($subServiceOrder->count()){
                                    $firstSubServiceTitle = $subServiceOrder->get()[0]->service->ar_title;
                            }
                        @endphp
                        <tr id="{{$order->id}}" @if($order->status==1) class="purble big-border-p text-white" @elseif($order->status==2) class="blu big-border-p text-white" @elseif($order->status==11) class="yelo big-border-p text-white" @elseif($order->status==5) class="rd big-border-p text-white" @elseif($order->status==3) class="gry big-border-p text-white" @elseif($order->status==13) class="gren big-border-p text-white" @endif  >
                            <td> {{$order->id}}</td>
                            <td> {{$order->date}}</td>
                            <td> {{$order->order_time}}</td>
                            <td> {{$order->service->ar_title}}</td>
                            <td> {{$order->number_of_cars}}</td>
                            <td>{{$order->service_basic->ar_title??''}}</td>
                            <td>{{$order->service_basic->ar_title??''}}</td>
                            <td>{{$firstSubServiceTitle}}</td>
                            <td> {{$order->place->ar_name??''}}</td>
                            <td>{{$order->user->full_name??''}}</td>
                            <td>{{$order->car_blade_number}}</td>
                            <td>
                                @if($order->status==1) جديد @elseif($order->status==2) جاري العمل @elseif($order->status==11) السائق بالطريق @elseif($order->status==5) تم الالغاء @elseif($order->status==3) انتهي العمل @elseif($order->status==13) تمت الخدمة @endif


                            </td>

                            <td> {{$order->user->phone_code??''}}{{$order->user->phone??''}}</td>
                            <td>{{$order->type->ar_title??''}}</td>
                            <td>{{$order->total_price??0}}</td>
                            <td>
                                <select class="form-select chooseDriver"  orderid="{{$order->id}}" id="target"  data-id="{{$order->id}}">
                                    <option value="" selected disabled> إختر السائق</option>
                                    @foreach($drivers as $driver)
                                        <option value="{{$driver->id}}" @if($driver->id == $order->driver_id)selected @endif>{{$driver->name}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td><a href="https://maps.google.com/?q={{$order->latitude}},{{$order->longitude}}" target="_blank"> <i class="fas fa-map-marker-alt"></i>
                                </a></td>
                            <td><a href="{{url("api/order/print/$order->id")}}" target="_blank"><i class="fas fa-file-pdf"></i> </a></td>
                            <td>
                                <a data-bs-toggle="modal" data-bs-target="#exampleModal" orderid="{{$order->id}}" class="showdetails"
                                   style="cursor: pointer;"> <i class="dripicons-information px-1 informationData"></i>
                                </a>

                                <a data-bs-toggle="modal" data-bs-target="#exampleModal2" class="editorder" orderid="{{$order->id}}"
                                   style="cursor: pointer;"> <i class="far fa-edit px-1 editOrder"></i>
                                </a>



                                <a  class="deleteorder" orderid="{{$order->id}}"
                                    style="cursor: pointer;"> <i class="far fa-trash-alt  px-1 deleteBtn"></i>
                                </a>                        </td>
                        </tr>
                    @endforeach

                @endisset
                </tbody>
            </table>
        </div>
    </div>
            </div>
        </div>
    </div>



    <!-- modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> تفاصيل الطلب </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body" id="mod-content-form">





                    <div class="row pt-4">
                        <div class="col-md-6">
                            <div class="mb-3 " >
                                <label class="form-label" for="default-input"> إسم العميل
                                </label>
                                <input class="form-control " disabled name="full_name"  value="" type="text" id="full_name"
                                       placeholder="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="default-input">رقم الجوال</label>
                                <input class="form-control numbersOnly" disabled name="phone" value="" type="text" id="phone"
                                       placeholder="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="default-input"> الحي </label>
                                <select class="form-select mo-form-select" disabled  name="place_id" id="place_id">
                                    <option value=""  disabled>الحي</option>
                                    @foreach($places as $place)
                                        <option value="{{$place->id}}" >{{$place->ar_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="default-input"> تاريخ الطلب
                                </label>
                                <input class="form-control" name="order_date" disabled value="" type="date" id="order_date"
                                       placeholder="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="default-input"> وقت الطلب
                                </label>
                                <input class="form-control" name="order_time" disabled value="" type="time" id="order_time"
                                       placeholder="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="default-input"> وسيلة الدفع
                                </label>
                                <select class="form-select mo-form-select" disabled name="payment_method" id="payment_method">
                                    <option value=""  disabled>وسيلة الدفع</option>
                                    <option value="2" >كاش</option>
                                    <option value="3" >نقطة البيع</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="default-input"> ماركة السيارة
                                </label>
                                <select class="form-select mo-form-select" disabled id="selectCarType" name="type_id">
                                    <option value=""  disabled>ماركة السيارة</option>
                                    @foreach($carTypes as $carType)
                                        <option value="{{$carType->id}}" >{{$carType->ar_title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="default-input"> الفئة </label>
                                <select class="form-select mo-form-select" disabled name="sub_type_id" id="sub_type_id">
                                    <option value=""  disabled>إختر الماركة أولا</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="default-input"> نوع الخدمة
                                </label>
                                <select class="form-select mo-form-select" disabled name="service_id" id="service_id">
                                    @foreach ($services as $service)
                                        <option value="{{$service->id}}">{{$service->ar_title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="default-input"> عدد السيارات
                                </label>
                                <div class="number">
                                    <span class="minus">-</span>
                                    <input class="count numbersOnly" name="number_of_cars" disabled value="" id="number_of_cars" type="text" />
                                    <span class="plus">+</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="default-input">الإجمالى
                                </label>
                                <input class="form-control numbersOnly" id="price_total" value="" disabled name="price_total" type="text"
                                       placeholder="">
                            </div>
                        </div>
                        {{--            <div class="col-md-6">--}}
                        {{--                <div class="mb-3">--}}
                        {{--                    <label class="form-label" for="default-input"> المزود--}}
                        {{--                    </label>--}}
                        {{--                    <select class="form-select mo-form-select" name="" id="">--}}
                        {{--                        <option value="">غسيل</option>--}}
                        {{--                    </select>--}}
                        {{--                </div>--}}
                        {{--            </div>--}}
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
                    <!-- <button type="button" class="btn btn-primary">   </button> -->
                </div>
            </div>
        </div>
    </div>






    <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> موقع السائق </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body " id="mod-content-form">


                    <form action="{{route('updateorderbyadmin')}}" id="my-form" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="order_time_id" value="27">

                        <div class="row pt-4">
                            <div class="col-md-6">
                                <div class="mb-3 " >
                                    <label class="form-label" for="default-input"> إسم العميل
                                    </label>
                                    <input class="form-control " name="full_name" value="" type="text" id="d_full_name"
                                           placeholder="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="default-input">رقم الجوال</label>
                                    <input class="form-control numbersOnly" name="phone" value="" type="text" id="d_phone"
                                           placeholder="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="default-input"> الحي </label>
                                    <select class="form-select mo-form-select"  name="place_id" id="d_place_id">
                                        <option value=""  disabled>الحي</option>
                                        @foreach($places as $place)
                                            <option value="{{$place->id}}" >{{$place->ar_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="default-input"> تاريخ الطلب
                                    </label>
                                    <input class="form-control" name="order_date" value="" type="date" id="d_order_date"
                                           placeholder="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="default-input"> وقت الطلب
                                    </label>
                                    <input class="form-control" name="order_time" value="" type="time" id="d_order_time"
                                           placeholder="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="default-input"> وسيلة الدفع
                                    </label>
                                    <select class="form-select mo-form-select" name="payment_method" id="d_payment_method">
                                        <option value=""  disabled>وسيلة الدفع</option>
                                        <option value="2" >كاش</option>
                                        <option value="3" >نقطة البيع</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="default-input"> ماركة السيارة
                                    </label>
                                    <select class="form-select mo-form-select" id="d_selectCarType" name="type_id">
                                        <option value=""  disabled>ماركة السيارة</option>
                                        @foreach($carTypes as $carType)
                                            <option value="{{$carType->id}}" >{{$carType->ar_title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="default-input"> الفئة </label>
                                    <select class="form-select mo-form-select" name="sub_type_id" id="d_sub_type_id">
                                        <option value=""  disabled>إختر الماركة أولا</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="default-input"> نوع الخدمة
                                    </label>
                                    <select class="form-select mo-form-select" name="service_id" id="d_service_id">
                                        @foreach ($services as $service)
                                            <option value="{{$service->id}}">{{$service->ar_title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="default-input"> عدد السيارات
                                    </label>
                                    <div class="number">
                                        <span class="minus">-</span>
                                        <input class="count numbersOnly" name="number_of_cars" value="" id="d_number_of_cars" type="text" />
                                        <span class="plus">+</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="default-input">الإجمالى
                                    </label>
                                    <input class="form-control numbersOnly" id="price_total" value="" readonly name="d_price_total" type="text"
                                           placeholder="">
                                </div>
                            </div>
                            {{--            <div class="col-md-6">--}}
                            {{--                <div class="mb-3">--}}
                            {{--                    <label class="form-label" for="default-input"> المزود--}}
                            {{--                    </label>--}}
                            {{--                    <select class="form-select mo-form-select" name="" id="">--}}
                            {{--                        <option value="">غسيل</option>--}}
                            {{--                    </select>--}}
                            {{--                </div>--}}
                            {{--            </div>--}}
                        </div>
                        <input id="checkbox-value" type="hidden" value="0">
                        <input id="total-value" type="hidden" value="0">
                        <input id="orderid" name="id" type="hidden" >

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
                            <button type="submit" class="btn btn-primary"> تعديل  </button>

                        </div>
                    </form>



                </div>

            </div>
        </div>
    </div>




@endsection

@section('style')

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('assets/admin/images/favicon.ico')}}">
    <!-- jvectormap -->
    <link href="{{asset('assets/admin/libs/jqvmap/jqvmap.min.css')}}" rel="stylesheet" />
    <!-- Bootstrap Css -->
    <link href="{{asset('assets/admin/css/bootstrap-rtl.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Plugins css -->
    <link href="{{asset('assets/admin/libs/dropzone/min/dropzone.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{asset('assets/admin/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{asset('assets/admin/css/app-rtl.min.css')}}" rel="stylesheet" type="text/css" />

@endsection

@section('js')


    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>



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



        function convert(){
            window.print();
        }
        $(document).on("click",".showdetails", function (e) {
            e.preventDefault();




            var id= $(this).attr('orderid');
            $.ajax({
                type:'GET',
                url:"{{route('showorder')}}",
                data:{
                    id:id,
                },

                success:function(res){
                    if(res['status']==true)
                    {
                        $('#full_name').val(res['order']['user']['full_name']);
                        $('#phone').val(res['order']['user']['phone']);
                        $('#order_date').val(res['order']['date']);
                        $('#order_time').val(res['order']['order_time']);

                        $('#number_of_cars').val(res['order']['number_of_cars']);
                        $('#price_total').val(res['order']['number_of_cars']);
                   var service=`<option selected>${res['order']['service']['ar_title']}</option>`;
                    $('#service_id').append(service);

                   var place=`<option selected>${res['order']['place']['ar_name']}</option>`;

                        $('#place_id').append(place);

                        if(res['order']['payment_method']==2)
                        {
                            var payment=`<option selected>كاش</option>`;

                            $('payment_method').append(payment);
                        }
                        else if(res['order']['payment_method']==3)
                        {
                            var payment=`<option selected>نقطة البيع</option>`;

                            $('#payment_method').append(payment);
                        }

                        var marka=`<option selected>${res['order']['type']['ar_title']}</option>`;

                        var cartype=`<option selected>${res['order']['sub_type']['ar_title']}</option>`;

                        $(`#selectCarType`).append(marka);
                         $(`#sub_type_id`).append(cartype);
                    }
                    else if(res['status']==false)
                        location.reload();


                },
                error: function(data){
                    alert('error');
                }
            });
        });
        $(document).on("click",".deleteorder", function (e) {
            e.preventDefault();
            var id= $(this).attr('orderid');
            $.ajax({
                type:'GET',
                url:"{{route('deleteorder')}}",
                data:{
                    id:id,
                },

                success:function(res){
                    if(res['status']==true)
                    {

                        $(`#${id}`).remove();

                    }
                    else if(res['status']==false)
                        location.reload();


                },
                error: function(data){
                    alert('error');
                }
            });

        });
    </script>


    <script>

        $(document).on("click",".editorder", function (e) {
            e.preventDefault();




            var id= $(this).attr('orderid');
            $('#orderid').val(id);
            $.ajax({
                type:'GET',
                url:"{{route('showorder')}}",
                data:{
                    id:id,
                },

                success:function(res){
                    if(res['status']==true)
                    {
                        console.log(res['mark']);
                        $('#d_full_name').val(res['order']['user']['full_name']);
                        $('#d_phone').val(res['order']['user']['phone']);
                        $('#d_order_date').val(res['order']['date']);
                        $('#d_order_time').val(res['order']['order_time']);

                        $('#d_number_of_cars').val(res['order']['number_of_cars']);
                        $('#d_price_total').val(res['order']['number_of_cars']);
                        var service=`<option selected value="${res['order']['service']['id']}">${res['order']['service']['ar_title']}</option>`;
                        $('#d_service_id').append(service);

                        var place=`<option value="${res['order']['place']['id']}" selected>${res['order']['place']['ar_name']}</option>`;

                        $('#d_place_id').append(place);

                        if(res['order']['payment_method']==2)
                        {
                            var payment=`<option value="2" selected>كاش</option>`;

                            $('#d_payment_method').append(payment);
                        }
                        else if(res['order']['payment_method']==3)
                        {
                            var payment=`<option value="3" selected>نقطة البيع</option>`;

                            $('#d_payment_method').append(payment);
                        }

                        var marka=`<option value="${res['order']['type']['id']}" selected>${res['order']['type']['ar_title']}</option>`;

                        var cartype=`<option value="${res['order']['sub_type']['id']}" selected>${res['order']['sub_type']['ar_title']}</option>`;
                        var cartypes=``;
                        for (var i=0;i<res['marks'].length ;i++)
                        {
                            cartypes =`<option value="${res['marks'][i]['id']}">${res['marks'][i]['ar_title']}</option>`;
                            $(`#d_sub_type_id`).append(cartypes);

                        }
                        $(`#d_selectCarType`).append(marka);
                        $(`#d_sub_type_id`).append(cartype);
                    }
                    else if(res['status']==false)
                        location.reload();


                },
                error: function(data){
                    alert('error');
                }
            });



        });


        $('#d_selectCarType').on('change', function() {
          var id=   this.value ;
            $(`#d_sub_type_id`).html(' <option value=""  disabled>إختر الماركة أولا</option>');

            $.ajax({
                type:'GET',
                url:"{{route('getsubcarbymaincar')}}",
                data:{
                    id:id,
                },

                success:function(res){
                    if(res['status']==true)
                    {

                        var cartypes=``;
                        $(`#d_sub_type_id`).html();

                        for (var i=0;i<res['cars'].length ;i++)
                        {
                            cartypes =`<option value="${res['cars'][i]['id']}">${res['cars'][i]['ar_title']}</option>`;
                            $(`#d_sub_type_id`).append(cartypes);

                        }

                    }
                    else if(res['status']==false)
                        location.reload();


                },
                error: function(data){
                    alert('error');
                }
            });

        });



    </script>


    <script>


        $('#my-form').on('submit',(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
             console.log(formData);
            $.ajax({
                type: 'POST',
                url: "{{route('updateorderbyadmin')}}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (res) {

                    if (res['status'] == true) {
                        $('#exampleModal2').modal('toggle');
                        swal(" تعديل الطلب ", "تم تعديل الطلب بنجاح", "success", {button: "حسناً",});
                        location.reload();


                    } else if (res['status'] == 'erorr') {
                        swal("    ", "  يرجي التاكد من البيانات", "warning", {button: "حسناً",});

                    }
                },
                error: function (data) {
                    swal("    ", "    رجاء المحاولة لاحقا ", "warning", {button: "حسناً",});
                }
            });
        }));

        $('.chooseDriver').on('change', function() {
             const driver_id= this.value ;
              var id=$(this).attr('orderid');
            $.ajax({
                type:'GET',
                url:"{{route('changedriver')}}",
                data:{
                    id:id,
                    driver_id:driver_id,
                },

                success:function(res){
                    if(res['status']==true)
                    {
                        swal("  تغير السائف ", "تم تغير  السائق بنجاح", "success", {button: "حسناً",});
                        location.reload();


                    }
                    else if(res['status']==false)
                        swal("  ", "  لا يمكن تغير السائق", "warning", {button: "حسناً",});

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
        $('#changeFilter').on('change',function(){
            var val = $(this).val();
            var myUrl = "{{route('getoperation')}}?month={{date('Y-m')}}&type=filter&filter="+val
            window.location = myUrl
        });
        $('#choseMonth').on('keyup keydown change', function(){
            var val = $(this).val();
            var myUrl = "{{route('getoperation')}}?month="+val+"&type=month";
            window.location = myUrl
        });
    </script>


    <script>

        var map, markers = [], marker

        function initMap() {
            var center = {lat: parseFloat({{$bigArray[0]['lat']}}), lng: parseFloat({{$bigArray[0]['lng']}})};
            var latLongArray = {!! json_encode($bigArray) !!};
            map = new google.maps.Map(document.getElementById("mapId"), {
                zoom: 15,
                center: center,
            });
            var image = {
                url: "https://washsquadsa.com/default.png",
                // This marker is 20 pixels wide by 32 pixels high.
                size: new google.maps.Size(30, 32),
                // The origin for this image is (0, 0).
                origin: new google.maps.Point(0, 0),
                // The anchor for this image is the base of the flagpole at (0, 32).
                anchor: new google.maps.Point(0, 32),
            };
            latLongArray.forEach(function (item, index) {
                marker = new google.maps.Marker({
                    position: {lat: parseFloat(item.lat), lng: parseFloat(item.lng)},
                    map,
                    icon: image,
                    title: item.name,
                });
                markers.push(marker)
            })

        }

        function initMap2(data) {
            for (var i = 0; i < markers.length; i++) {
                markers[i].setMap(null);
            }
            var image = {
                url: "https://washsquadsa.com/default.png",
                // This marker is 20 pixels wide by 32 pixels high.
                size: new google.maps.Size(30, 32),
                // The origin for this image is (0, 0).
                origin: new google.maps.Point(0, 0),
                // The anchor for this image is the base of the flagpole at (0, 32).
                anchor: new google.maps.Point(0, 32),
            };
            markers = [];
            data.forEach(function (item, index) {
                marker = new google.maps.Marker({
                    position: {lat: parseFloat(item.lat), lng: parseFloat(item.lng)},
                    map,
                    icon: image,
                    title: item.name,

                });
                markers.push(marker)
            })
        }

        window.initMap = initMap;
        setInterval(function () {
            // document.getElementById("map").innerHTML = ''
            $.get("{{route('carTrack')}}", function (data) {
                initMap2(data)
                window.initMap = initMap2;

            })
        }, 5000);
    </script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDRH058OG79geHwTA1xw5hlOmomHIFbj94&callback=initMap&language=ar"
        defer
    ></script>



@endsection

