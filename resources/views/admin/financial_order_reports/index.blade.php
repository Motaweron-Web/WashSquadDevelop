@extends('admin.layouts.inc.app')
@section('class')
@endsection
@section('style')


@endsection

@section('content')


    <div class="page-content">
        <!-- date -->
        <div class="d-flex flex-wrap justify-content-end mb-3">
            <div class="p-2">
                <select  class="form-select ">
                    <option selected disabled> حالة الطلب </option>
                    <option value="13"> مكتملة  </option>
                    <option value="5"> ملغية  </option>
                    <option value="1"> جديد  </option>
                </select>
            </div>
            <div class="p-2">
                <input type="month" class="form-control" id="choseMonth-change" value="{{$request->month}}">

            </div>

            <div class="p-2">
                <div class="p-2">


                    <a href="{{route('admin.FinancialOrderReports.excel')}}" class="btn  exportExcel" id="downloadExcel" type="button"> <i class="fas fa-download me-2"></i> Export Excel
                    </a>

            </div>
        </div>
        <!-- table -->
        <div class="apps drivers my-5">
            <h2 class="mb-4"> تطبيق ووش سكواد </h2>
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
                            <th> السائق </th>
                            <th> الدفع </th>
                            <th> </th>
                        </tr>
                        </thead>
                        <tbody>
                        @isset($soros)
                            @foreach ($WhooshSquads as $user)
                            @foreach ($user->orders as $order)
                                <tr>
                                    <td>{{$order->id ?? '--'}}>
                                    <td>{{$order->order_date ?? '--'}} </td>
                                    <td> {{$order->order_type ?? '--'}}</td>

                                        <td> {{$order->distributor->full_name ?? 'wash'}}</td>


                                    <td> {{$order->number_of_cars ?? '--'}}</td>
                                    <td> {{$order->service_id ?? '--'}}</td>
                                    <td>{{ ($order->sub_service_id) ?? '--'}}</td>
                                    <td>{{$order->sub_type_id ?? '--'}}</td>
                                    <td>{{$order->place_id ?? '--'}}</td>
                                    <td>{{$order->user->name ?? '--'}}</td>
                                    <td>{{$order->user->phone ?? '--'}}</td>

                                    <td>   {{$order->total_price ?? '--'}}</td>
                                    <td> {{$order->driver_id ?? '--'}} </td>

                                    <td>  {{$order->id ?? '--'}}</td>


                                    @if($order -> status == 1)
                                        <td><span class="badge badge-info">'طلب جديد'</span> </td>
                                    @elseif($order -> status == 5)
                                        <td><span class="badge badge-danger">'طلب ملغى' </span> </td>
                                    @elseif($order -> status == 13)
                                        <td><span class="badge badge-Success">'طلب مكتمل' </span> </td>
                                    @endif



                                    <td> <button class="active"> Complete </button> </td>
                                </tr>

                            @endforeach
                            @endforeach
                        @endisset
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- table -->
        <div class="apps drivers my-5">

            <h2 class="mb-4"> تطبيق سرور </h2>
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
                            <th> السائق </th>
                            <th> الدفع </th>
                            <th> </th>
                        </tr>
                        </thead>
                        <tbody>
                                  @foreach($soros->orders as $order)
                                                <tr>
                                                    <td>{{$order->id ?? '--'}}</td>
                                                    <td>{{$order->order_date ?? '--'}} </td>
                                                    <td> {{$order->order_type ?? '--'}}</td>
                                                    <td> {{$order->distributor->full_name ?? 'wash'}}</td>
                                                    <td> {{$order->number_of_cars ?? '--'}}</td>
                                                    <td> {{$order->service_id ?? '--'}}</td>
                                                    <td>{{($order->sub_service_id) ?? '--'}}</td>
                                                    <td>{{$order->sub_type_id ?? '--'}}</td>
                                                    <td>{{$order->place_id ?? '--'}}</td>
                                                    <td>{{$order->user->name ?? '--'}}</td>
                                                    <td>{{$order->user->phone ?? '--'}}</td>

                                                    <td>   {{$order->total_price ?? '--'}}</td>
                                                    <td> {{$order->driver_id ?? '--'}} </td>


                                                    <td>  {{$order->id ?? '--'}}</td>


                                                    @if($order -> status == 1)
                                                        <td><span class="badge badge-info">'طلب جديد'</span> </td>
                                                    @elseif($order -> status == 5)
                                                        <td><span class="badge badge-danger">'طلب ملغى' </span> </td>
                                                    @elseif($order -> status == 13)
                                                        <td><span class="badge badge-Success">'طلب مكتمل' </span> </td>
                                                    @endif
                                                </tr>
                                                    @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>



        <!-- table -->
        <div class="apps drivers my-5">
            <h2 class="mb-4"> تطبيق غسيل </h2>
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
                            <th> السائق </th>
                            <th> الدفع </th>
                            <th> </th>
                        </tr>
                        </thead>
                        <tbody>

                        <tr>
                        @foreach($washs->orders as $order)
                            <tr>
                                <td>{{$order->id ?? '--'}}</td>
                                <td>{{$order->order_date ?? '--'}} </td>
                                <td> {{$order->order_type ?? '--'}}</td>
                                <td> {{$order->distributor->full_name ?? 'wash'}}</td>
                                <td> {{$order->number_of_cars ?? '--'}}</td>
                                <td> {{$order->service_id ?? '--'}}</td>
                                <td>{{($order->sub_service_id) ?? '--'}}</td>
                                <td>{{$order->sub_type_id ?? '--'}}</td>
                                <td>{{$order->place_id ?? '--'}}</td>
                                <td>{{$order->user->name ?? '--'}}</td>
                                <td>{{$order->user->phone ?? '--'}}</td>

                                <td>   {{$order->total_price ?? '--'}}</td>
                                <td> {{$order->driver_id ?? '--'}} </td>


                                <td>  {{$order->id ?? '--'}}</td>


                                @if($order -> status == 1)
                                    <td><span class="badge badge-info">'طلب جديد'</span> </td>
                                @elseif($order -> status == 5)
                                    <td><span class="badge badge-danger">'طلب ملغى' </span> </td>
                                @elseif($order -> status == 13)
                                    <td><span class="badge badge-Success">'طلب مكتمل' </span> </td>
                                @endif
                            </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="apps drivers my-5">
            <h2 class="mb-4"> تطبيق مسوق </h2>
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
                            <th> السائق </th>
                            <th> الدفع </th>
                            <th> </th>
                        </tr>
                        </thead>
                        <tbody>

                        <tr>
                        @foreach($marketers->orders as $order)
                            <tr>
                                <td>{{$order->id ?? '--'}}</td>
                                <td>{{$order->order_date ?? '--'}} </td>
                                <td> {{$order->order_type ?? '--'}}</td>
                                <td> {{$order->distributor->full_name ?? 'wash'}}</td>
                                <td> {{$order->number_of_cars ?? '--'}}</td>
                                <td> {{$order->service_id ?? '--'}}</td>
                                <td>{{($order->sub_service_id) ?? '--'}}</td>
                                <td>{{$order->sub_type_id ?? '--'}}</td>
                                <td>{{$order->place_id ?? '--'}}</td>
                                <td>{{$order->user->name ?? '--'}}</td>
                                <td>{{$order->user->phone ?? '--'}}</td>

                                <td>   {{$order->total_price ?? '--'}}</td>
                                <td> {{$order->driver_id ?? '--'}} </td>


                                <td>  {{$order->id ?? '--'}}</td>


                                @if($order -> status == 1)
                                    <td><span class="badge badge-info">'طلب جديد'</span> </td>
                                @elseif($order -> status == 5)
                                    <td><span class="badge badge-danger">'طلب ملغى' </span> </td>
                                @elseif($order -> status == 13)
                                    <td><span class="badge badge-Success">'طلب مكتمل' </span> </td>
                                @endif
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="apps drivers my-5">
            <h2 class="mb-4"> تطبيق ghaseel </h2>
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
                            <th> السائق </th>
                            <th> الدفع </th>
                            <th> </th>
                        </tr>
                        </thead>
                        <tbody>

                        <tr>
                        @foreach($ghaseels->orders as $order)
                            <tr>
                                <td>{{$order->id ?? '--'}}</td>
                                <td>{{$order->order_date ?? '--'}} </td>
                                <td> {{$order->order_type ?? '--'}}</td>
                                <td> {{$order->distributor->full_name ?? 'wash'}}</td>
                                <td> {{$order->number_of_cars ?? '--'}}</td>
                                <td> {{$order->service_id ?? '--'}}</td>
                                <td>{{($order->sub_service_id) ?? '--'}}</td>
                                <td>{{$order->sub_type_id ?? '--'}}</td>
                                <td>{{$order->place_id ?? '--'}}</td>
                                <td>{{$order->user->name ?? '--'}}</td>
                                <td>{{$order->user->phone ?? '--'}}</td>

                                <td>   {{$order->total_price ?? '--'}}</td>
                                <td> {{$order->driver_id ?? '--'}} </td>

                                <td>  {{$order->id ?? '--'}}</td>



                                @if($order -> status == 1)
                                    <td><span class="badge badge-info">'طلب جديد'</span> </td>
                                @elseif($order -> status == 5)
                                    <td><span class="badge badge-danger">'طلب ملغى' </span> </td>
                                @elseif($order -> status == 13)
                                    <td><span class="badge badge-Success">'طلب مكتمل' </span> </td>
                                @endif
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="apps drivers my-5">
            <h2 class="mb-4"> تطبيق carspas </h2>
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
                            <th> السائق </th>
                            <th> الدفع </th>
                            <th> </th>
                        </tr>
                        </thead>
                        <tbody>

                        <tr>
                        @foreach($carspas->orders as $order)
                            <tr>
                                <td>{{$order->id ?? '--'}}</td>
                                <td>{{$order->order_date ?? '--'}} </td>
                                <td> {{$order->order_type ?? '--'}}</td>
                                <td> {{$order->distributor->full_name ?? 'wash'}}</td>
                                <td> {{$order->number_of_cars ?? '--'}}</td>
                                <td> {{$order->service_id ?? '--'}}</td>
                                <td>{{($order->sub_service_id) ?? '--'}}</td>
                                <td>{{$order->sub_type_id ?? '--'}}</td>
                                <td>{{$order->place_id ?? '--'}}</td>
                                <td>{{$order->user->name ?? '--'}}</td>
                                <td>{{$order->user->phone ?? '--'}}</td>

                                <td>   {{$order->total_price ?? '--'}}</td>
                                <td> {{$order->driver_id ?? '--'}} </td>

                                <td>  {{$order->id ?? '--'}}</td>



                                @if($order -> status == 1)
                                    <td><span class="badge badge-info">'طلب جديد'</span> </td>
                                @elseif($order -> status == 5)
                                    <td><span class="badge badge-danger">'طلب ملغى' </span> </td>
                                @elseif($order -> status == 13)
                                    <td><span class="badge badge-Success">'طلب مكتمل' </span> </td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="apps drivers my-5">
            <h2 class="mb-4"> تطبيق sayar </h2>
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
                            <th> السائق </th>
                            <th> الدفع </th>
                            <th> </th>
                        </tr>
                        </thead>
                        <tbody>

                        <tr>
                        @foreach($sayars->orders as $order)
                            <tr>
                                <td>{{$order->id ?? '--'}}</td>
                                <td>{{$order->order_date ?? '--'}} </td>
                                <td> {{$order->order_type ?? '--'}}</td>
                                <td> {{$order->distributor->full_name ?? 'wash'}}</td>
                                <td> {{$order->number_of_cars ?? '--'}}</td>
                                <td> {{$order->service_id ?? '--'}}</td>
                                <td>{{($order->sub_service_id) ?? '--'}}</td>
                                <td>{{$order->sub_type_id ?? '--'}}</td>
                                <td>{{$order->place_id ?? '--'}}</td>
                                <td>{{$order->user->name ?? '--'}}</td>
                                <td>{{$order->user->phone ?? '--'}}</td>

                                <td>   {{$order->total_price ?? '--'}}</td>
                                <td> {{$order->driver_id ?? '--'}} </td>

                                <td>  {{$order->id ?? '--'}}</td>



                                @if($order -> status == 1)
                                    <td><span class="badge badge-info">'طلب جديد'</span> </td>
                                @elseif($order -> status == 5)
                                    <td><span class="badge badge-danger">'طلب ملغى' </span> </td>
                                @elseif($order -> status == 13)
                                    <td><span class="badge badge-Success">'طلب مكتمل' </span> </td>
                                @endif
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="apps drivers my-5">
            <h2 class="mb-4"> تطبيق T1654 </h2>
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
                            <th> السائق </th>
                            <th> الدفع </th>
                            <th> </th>
                        </tr>
                        </thead>
                        <tbody>

                        <tr>
                        @foreach($T1654s->orders as $order)
                            <tr>
                                <td>{{$order->id ?? '--'}}</td>
                                <td>{{$order->order_date ?? '--'}} </td>
                                <td> {{$order->order_type ?? '--'}}</td>
                                <td> {{$order->distributor->full_name ?? 'wash'}}</td>
                                <td> {{$order->number_of_cars ?? '--'}}</td>
                                <td> {{$order->service_id ?? '--'}}</td>
                                <td>{{($order->sub_service_id) ?? '--'}}</td>
                                <td>{{$order->sub_type_id ?? '--'}}</td>
                                <td>{{$order->place_id ?? '--'}}</td>
                                <td>{{$order->user->name ?? '--'}}</td>
                                <td>{{$order->user->phone ?? '--'}}</td>

                                <td>   {{$order->total_price ?? '--'}}</td>
                                <td> {{$order->driver_id ?? '--'}} </td>

                                <td>  {{$order->id ?? '--'}}</td>



                                @if($order -> status == 1)
                                    <td><span class="badge badge-info">'طلب جديد'</span> </td>
                                @elseif($order -> status == 5)
                                    <td><span class="badge badge-danger">'طلب ملغى' </span> </td>
                                @elseif($order -> status == 13)
                                    <td><span class="badge badge-Success">'طلب مكتمل' </span> </td>
                                @endif
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="apps drivers my-5">
            <h2 class="mb-4"> تطبيق T3671 </h2>
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
                            <th> السائق </th>
                            <th> الدفع </th>
                            <th> </th>
                        </tr>
                        </thead>
                        <tbody>

                        <tr>
                        @foreach($T3671s->orders as $order)
                            <tr>
                                <td>{{$order->id ?? '--'}}</td>
                                <td>{{$order->order_date ?? '--'}} </td>
                                <td> {{$order->order_type ?? '--'}}</td>
                                <td> {{$order->distributor->full_name ?? 'wash'}}</td>
                                <td> {{$order->number_of_cars ?? '--'}}</td>
                                <td> {{$order->service_id ?? '--'}}</td>
                                <td>{{($order->sub_service_id) ?? '--'}}</td>
                                <td>{{$order->sub_type_id ?? '--'}}</td>
                                <td>{{$order->place_id ?? '--'}}</td>
                                <td>{{$order->user->name ?? '--'}}</td>
                                <td>{{$order->user->phone ?? '--'}}</td>

                                <td>   {{$order->total_price ?? '--'}}</td>
                                <td> {{$order->driver_id ?? '--'}} </td>

                                <td>  {{$order->id ?? '--'}}</td>



                                @if($order -> status == 1)
                                    <td><span class="badge badge-info">'طلب جديد'</span> </td>
                                @elseif($order -> status == 5)
                                    <td><span class="badge badge-danger">'طلب ملغى' </span> </td>
                                @elseif($order -> status == 13)
                                    <td><span class="badge badge-Success">'طلب مكتمل' </span> </td>
                                @endif
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <div class="apps drivers my-5">
            <h2 class="mb-4"> تطبيق T1677 </h2>
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
                            <th> السائق </th>
                            <th> الدفع </th>
                            <th> </th>
                        </tr>
                        </thead>
                        <tbody>

                        <tr>
                        @foreach($T1677s->orders as $order)
                            <tr>
                                <td>{{$order->id ?? '--'}}</td>
                                <td>{{$order->order_date ?? '--'}} </td>
                                <td> {{$order->order_type ?? '--'}}</td>
                                <td> {{$order->distributor->full_name ?? 'wash'}}</td>
                                <td> {{$order->number_of_cars ?? '--'}}</td>
                                <td> {{$order->service_id ?? '--'}}</td>
                                <td>{{($order->sub_service_id) ?? '--'}}</td>
                                <td>{{$order->sub_type_id ?? '--'}}</td>
                                <td>{{$order->place_id ?? '--'}}</td>
                                <td>{{$order->user->name ?? '--'}}</td>
                                <td>{{$order->user->phone ?? '--'}}</td>

                                <td>   {{$order->total_price ?? '--'}}</td>
                                <td> {{$order->driver_id ?? '--'}} </td>

                                <td>  {{$order->id ?? '--'}}</td>



                                @if($order -> status == 1)
                                    <td><span class="badge badge-info">'طلب جديد'</span> </td>
                                @elseif($order -> status == 5)
                                    <td><span class="badge badge-danger">'طلب ملغى' </span> </td>
                                @elseif($order -> status == 13)
                                    <td><span class="badge badge-Success">'طلب مكتمل' </span> </td>
                                @endif
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>



        <div class="apps drivers my-5">
            <h2 class="mb-4"> تطبيق T7982 </h2>
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
                            <th> السائق </th>
                            <th> الدفع </th>
                            <th> </th>
                        </tr>
                        </thead>
                        <tbody>

                        <tr>
                        @foreach($T7982s->orders as $order)
                            <tr>
                                <td>{{$order->id ?? '--'}}</td>
                                <td>{{$order->order_date ?? '--'}} </td>
                                <td> {{$order->order_type ?? '--'}}</td>
                                <td> {{$order->distributor->full_name ?? 'wash'}}</td>
                                <td> {{$order->number_of_cars ?? '--'}}</td>
                                <td> {{$order->service_id ?? '--'}}</td>
                                <td>{{($order->sub_service_id) ?? '--'}}</td>
                                <td>{{$order->sub_type_id ?? '--'}}</td>
                                <td>{{$order->place_id ?? '--'}}</td>
                                <td>{{$order->user->name ?? '--'}}</td>
                                <td>{{$order->user->phone ?? '--'}}</td>

                                <td>   {{$order->total_price ?? '--'}}</td>
                                <td> {{$order->driver_id ?? '--'}} </td>

                                <td>  {{$order->id ?? '--'}}</td>



                                @if($order -> status == 1)
                                    <td><span class="badge badge-info">'طلب جديد'</span> </td>
                                @elseif($order -> status == 5)
                                    <td><span class="badge badge-danger">'طلب ملغى' </span> </td>
                                @elseif($order -> status == 13)
                                    <td><span class="badge badge-Success">'طلب مكتمل' </span> </td>
                                @endif
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <div class="apps drivers my-5">
            <h2 class="mb-4"> تطبيق T3996 </h2>
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
                            <th> السائق </th>
                            <th> الدفع </th>
                            <th> </th>
                        </tr>
                        </thead>
                        <tbody>

                        <tr>
                        @foreach($T3996s->orders as $order)
                            <tr>
                                <td>{{$order->id ?? '--'}}</td>
                                <td>{{$order->order_date ?? '--'}} </td>
                                <td> {{$order->order_type ?? '--'}}</td>
                                <td> {{$order->distributor->full_name ?? 'wash'}}</td>
                                <td> {{$order->number_of_cars ?? '--'}}</td>
                                <td> {{$order->service_id ?? '--'}}</td>
                                <td>{{($order->sub_service_id) ?? '--'}}</td>
                                <td>{{$order->sub_type_id ?? '--'}}</td>
                                <td>{{$order->place_id ?? '--'}}</td>
                                <td>{{$order->user->name ?? '--'}}</td>
                                <td>{{$order->user->phone ?? '--'}}</td>

                                <td>   {{$order->total_price ?? '--'}}</td>
                                <td> {{$order->driver_id ?? '--'}} </td>


                                <td>  {{$order->id ?? '--'}}</td>


                                @if($order -> status == 1)
                                    <td><span class="badge badge-info">'طلب جديد'</span> </td>
                                @elseif($order -> status == 5)
                                    <td><span class="badge badge-danger">'طلب ملغى' </span> </td>
                                @elseif($order -> status == 13)
                                    <td><span class="badge badge-Success">'طلب مكتمل' </span> </td>
                                @endif
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <div class="apps drivers my-5">
            <h2 class="mb-4"> تطبيق T4482 </h2>
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
                            <th> السائق </th>
                            <th> الدفع </th>
                            <th> </th>
                        </tr>
                        </thead>
                        <tbody>

                        <tr>
                        @foreach($T4482s->orders as $order)
                            <tr>
                                <td>{{$order->id ?? '--'}}</td>
                                <td>{{$order->order_date ?? '--'}} </td>
                                <td> {{$order->order_type ?? '--'}}</td>
                                <td> {{$order->number_of_cars ?? '--'}}</td>
                                <td> {{$order->service_id ?? '--'}}</td>
                                <td>{{($order->sub_service_id) ?? '--'}}</td>
                                <td>{{$order->sub_type_id ?? '--'}}</td>
                                <td>{{$order->place_id ?? '--'}}</td>
                                <td>{{$order->user->name ?? '--'}}</td>
                                <td>{{$order->user->phone ?? '--'}}</td>

                                <td>   {{$order->total_price ?? '--'}}</td>
                                <td> {{$order->driver_id ?? '--'}} </td>

                                <td>  {{$order->id ?? '--'}}</td>
                                <td>  {{$order->id ?? '--'}}</td>


                                @if($order -> status == 1)
                                    <td><span class="badge badge-info">'طلب جديد'</span> </td>
                                @elseif($order -> status == 5)
                                    <td><span class="badge badge-danger">'طلب ملغى' </span> </td>
                                @elseif($order -> status == 13)
                                    <td><span class="badge badge-Success">'طلب مكتمل' </span> </td>
                                @endif
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <div class="apps drivers my-5">
            <h2 class="mb-4"> تطبيق T2470 </h2>
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
                            <th> السائق </th>
                            <th> الدفع </th>
                            <th> </th>
                        </tr>
                        </thead>
                        <tbody>

                        <tr>
                        @foreach($T2470s->orders as $order)
                            <tr>
                                <td>{{$order->id ?? '--'}}</td>
                                <td>{{$order->order_date ?? '--'}} </td>
                                <td> {{$order->order_type ?? '--'}}</td>
                                <td> {{$order->number_of_cars ?? '--'}}</td>
                                <td> {{$order->service_id ?? '--'}}</td>
                                <td>{{($order->sub_service_id) ?? '--'}}</td>
                                <td>{{$order->sub_type_id ?? '--'}}</td>
                                <td>{{$order->place_id ?? '--'}}</td>
                                <td>{{$order->user->name ?? '--'}}</td>
                                <td>{{$order->user->phone ?? '--'}}</td>

                                <td>   {{$order->total_price ?? '--'}}</td>
                                <td> {{$order->driver_id ?? '--'}} </td>

                                <td>  {{$order->id ?? '--'}}</td>
                                <td>  {{$order->id ?? '--'}}</td>


                                @if($order -> status == 1)
                                    <td><span class="badge badge-info">'طلب جديد'</span> </td>
                                @elseif($order -> status == 5)
                                    <td><span class="badge badge-danger">'طلب ملغى' </span> </td>
                                @elseif($order -> status == 13)
                                    <td><span class="badge badge-Success">'طلب مكتمل' </span> </td>
                                @endif
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <div class="apps drivers my-5">
            <h2 class="mb-4"> تطبيق done </h2>
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
                            <th> السائق </th>
                            <th> الدفع </th>
                            <th> </th>
                        </tr>
                        </thead>
                        <tbody>

                        <tr>
                        @foreach($dones->orders as $order)
                            <tr>
                                <td>{{$order->id ?? '--'}}</td>
                                <td>{{$order->order_date ?? '--'}} </td>
                                <td> {{$order->order_type ?? '--'}}</td>
                                <td> {{$order->number_of_cars ?? '--'}}</td>
                                <td> {{$order->service_id ?? '--'}}</td>
                                <td>{{($order->sub_service_id) ?? '--'}}</td>
                                <td>{{$order->sub_type_id ?? '--'}}</td>
                                <td>{{$order->place_id ?? '--'}}</td>
                                <td>{{$order->user->name ?? '--'}}</td>
                                <td>{{$order->user->phone ?? '--'}}</td>

                                <td>   {{$order->total_price ?? '--'}}</td>
                                <td> {{$order->driver_id ?? '--'}} </td>

                                <td>  {{$order->id ?? '--'}}</td>
                                <td>  {{$order->id ?? '--'}}</td>


                                @if($order -> status == 1)
                                    <td><span class="badge badge-info">'طلب جديد'</span> </td>
                                @elseif($order -> status == 5)
                                    <td><span class="badge badge-danger">'طلب ملغى' </span> </td>
                                @elseif($order -> status == 13)
                                    <td><span class="badge badge-Success">'طلب مكتمل' </span> </td>
                                @endif
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <div class="apps drivers my-5">
            <h2 class="mb-4"> تطبيق t4762 </h2>
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
                            <th> السائق </th>
                            <th> الدفع </th>
                            <th> </th>
                        </tr>
                        </thead>
                        <tbody>

                        <tr>
                        @foreach($t4762s->orders as $order)
                            <tr>
                                <td>{{$order->id ?? '--'}}</td>
                                <td>{{$order->order_date ?? '--'}} </td>
                                <td> {{$order->order_type ?? '--'}}</td>
                                <td> {{$order->number_of_cars ?? '--'}}</td>
                                <td> {{$order->service_id ?? '--'}}</td>
                                <td>{{($order->sub_service_id) ?? '--'}}</td>
                                <td>{{$order->sub_type_id ?? '--'}}</td>
                                <td>{{$order->place_id ?? '--'}}</td>
                                <td>{{$order->user->name ?? '--'}}</td>
                                <td>{{$order->user->phone ?? '--'}}</td>

                                <td>   {{$order->total_price ?? '--'}}</td>
                                <td> {{$order->driver_id ?? '--'}} </td>

                                <td>  {{$order->id ?? '--'}}</td>
                                <td>  {{$order->id ?? '--'}}</td>


                                @if($order -> status == 1)
                                    <td><span class="badge badge-info">'طلب جديد'</span> </td>
                                @elseif($order -> status == 5)
                                    <td><span class="badge badge-danger">'طلب ملغى' </span> </td>
                                @elseif($order -> status == 13)
                                    <td><span class="badge badge-Success">'طلب مكتمل' </span> </td>
                                @endif
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <div class="apps drivers my-5">
            <h2 class="mb-4"> تطبيق t4651 </h2>
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
                            <th> السائق </th>
                            <th> الدفع </th>
                            <th> </th>
                        </tr>
                        </thead>
                        <tbody>

                        <tr>
                        @foreach($t4651s->orders as $order)
                            <tr>
                                <td>{{$order->id ?? '--'}}</td>
                                <td>{{$order->order_date ?? '--'}} </td>
                                <td> {{$order->order_type ?? '--'}}</td>
                                <td> {{$order->distributor->full_name ?? 'wash'}}</td>
                                <td> {{$order->number_of_cars ?? '--'}}</td>
                                <td> {{$order->service_id ?? '--'}}</td>
                                <td>{{($order->sub_service_id) ?? '--'}}</td>
                                <td>{{$order->sub_type_id ?? '--'}}</td>
                                <td>{{$order->place_id ?? '--'}}</td>
                                <td>{{$order->user->name ?? '--'}}</td>
                                <td>{{$order->user->phone ?? '--'}}</td>

                                <td>   {{$order->total_price ?? '--'}}</td>
                                <td> {{$order->driver_id ?? '--'}} </td>


                                <td>  {{$order->id ?? '--'}}</td>


                                @if($order -> status == 1)
                                    <td><span class="badge badge-info">'طلب جديد'</span> </td>
                                @elseif($order -> status == 5)
                                    <td><span class="badge badge-danger">'طلب ملغى' </span> </td>
                                @elseif($order -> status == 13)
                                    <td><span class="badge badge-Success">'طلب مكتمل' </span> </td>
                                @endif
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>



        <div class="apps drivers my-5">
            <h2 class="mb-4"> تطبيق سحر </h2>
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
                            <th> السائق </th>
                            <th> الدفع </th>
                            <th> </th>
                        </tr>
                        </thead>
                        <tbody>

                        <tr>
                        @foreach($sahars->orders as $order)
                            <tr>
                                <td>{{$order->id ?? '--'}}</td>
                                <td>{{$order->order_date ?? '--'}} </td>
                                <td> {{$order->order_type ?? '--'}}</td>
                                <td> {{$order->distributor->full_name ?? 'wash'}}</td>
                                <td> {{$order->number_of_cars ?? '--'}}</td>
                                <td> {{$order->service_id ?? '--'}}</td>
                                <td>{{($order->sub_service_id) ?? '--'}}</td>
                                <td>{{$order->sub_type_id ?? '--'}}</td>
                                <td>{{$order->place_id ?? '--'}}</td>
                                <td>{{$order->user->name ?? '--'}}</td>
                                <td>{{$order->user->phone ?? '--'}}</td>

                                <td>   {{$order->total_price ?? '--'}}</td>
                                <td> {{$order->driver_id ?? '--'}} </td>


                                <td>  {{$order->id ?? '--'}}</td>


                                @if($order -> status == 1)
                                    <td><span class="badge badge-info">'طلب جديد'</span> </td>
                                @elseif($order -> status == 5)
                                    <td><span class="badge badge-danger">'طلب ملغى' </span> </td>
                                @elseif($order -> status == 13)
                                    <td><span class="badge badge-Success">'طلب مكتمل' </span> </td>
                                @endif
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>



        <div class="apps drivers my-5">
            <h2 class="mb-4"> تطبيق ابراهيم 2 </h2>
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
                            <th> السائق </th>
                            <th> الدفع </th>
                            <th> </th>
                        </tr>
                        </thead>
                        <tbody>

                        <tr>
                        @foreach($sibrahims->orders as $order)
                            <tr>
                                <td>{{$order->id ?? '--'}}</td>
                                <td>{{$order->order_date ?? '--'}} </td>
                                <td> {{$order->order_type ?? '--'}}</td>
                                <td> {{$order->distributor->full_name ?? 'wash'}}</td>
                                <td> {{$order->number_of_cars ?? '--'}}</td>
                                <td> {{$order->service_id ?? '--'}}</td>
                                <td>{{($order->sub_service_id) ?? '--'}}</td>
                                <td>{{$order->sub_type_id ?? '--'}}</td>
                                <td>{{$order->place_id ?? '--'}}</td>
                                <td>{{$order->user->name ?? '--'}}</td>
                                <td>{{$order->user->phone ?? '--'}}</td>

                                <td>   {{$order->total_price ?? '--'}}</td>
                                <td> {{$order->driver_id ?? '--'}} </td>


                                <td>  {{$order->id ?? '--'}}</td>


                                @if($order -> status == 1)
                                    <td><span class="badge badge-info">'طلب جديد'</span> </td>
                                @elseif($order -> status == 5)
                                    <td><span class="badge badge-danger">'طلب ملغى' </span> </td>
                                @elseif($order -> status == 13)
                                    <td><span class="badge badge-Success">'طلب مكتمل' </span> </td>
                                @endif
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>




        <div class="apps drivers my-5">
            <h2 class="mb-4"> تطبيق غادة </h2>
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
                            <th> السائق </th>
                            <th> الدفع </th>
                            <th> </th>
                        </tr>
                        </thead>
                        <tbody>

                        <tr>
                        @foreach($ghadas->orders as $order)
                            <tr>
                                <td>{{$order->id ?? '--'}}</td>
                                <td>{{$order->order_date ?? '--'}} </td>
                                <td> {{$order->order_type ?? '--'}}</td>
                                <td> {{$order->distributor->full_name ?? 'wash'}}</td>
                                <td> {{$order->number_of_cars ?? '--'}}</td>
                                <td> {{$order->service_id ?? '--'}}</td>
                                <td>{{($order->sub_service_id) ?? '--'}}</td>
                                <td>{{$order->sub_type_id ?? '--'}}</td>
                                <td>{{$order->place_id ?? '--'}}</td>
                                <td>{{$order->user->name ?? '--'}}</td>
                                <td>{{$order->user->phone ?? '--'}}</td>

                                <td>   {{$order->total_price ?? '--'}}</td>
                                <td> {{$order->driver_id ?? '--'}} </td>


                                <td>  {{$order->id ?? '--'}}</td>


                                @if($order -> status == 1)
                                    <td><span class="badge badge-info">'طلب جديد'</span> </td>
                                @elseif($order -> status == 5)
                                    <td><span class="badge badge-danger">'طلب ملغى' </span> </td>
                                @elseif($order -> status == 13)
                                    <td><span class="badge badge-Success">'طلب مكتمل' </span> </td>
                                @endif
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>




        <div class="apps drivers my-5">
            <h2 class="mb-4"> تطبيق خالد </h2>
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
                            <th> السائق </th>
                            <th> الدفع </th>
                            <th> </th>
                        </tr>
                        </thead>
                        <tbody>

                        <tr>
                        @foreach($skhaleds->orders as $order)
                            <tr>
                                <td>{{$order->id ?? '--'}}</td>
                                <td>{{$order->order_date ?? '--'}} </td>
                                <td> {{$order->order_type ?? '--'}}</td>
                                <td> {{$order->distributor->full_name ?? 'wash'}}</td>
                                <td> {{$order->number_of_cars ?? '--'}}</td>
                                <td> {{$order->service_id ?? '--'}}</td>
                                <td>{{($order->sub_service_id) ?? '--'}}</td>
                                <td>{{$order->sub_type_id ?? '--'}}</td>
                                <td>{{$order->place_id ?? '--'}}</td>
                                <td>{{$order->user->name ?? '--'}}</td>
                                <td>{{$order->user->phone ?? '--'}}</td>

                                <td>   {{$order->total_price ?? '--'}}</td>
                                <td> {{$order->driver_id ?? '--'}} </td>

                                <td>  {{$order->id ?? '--'}}</td>


                                @if($order -> status == 1)
                                    <td><span class="badge badge-info">'طلب جديد'</span> </td>
                                @elseif($order -> status == 5)
                                    <td><span class="badge badge-danger">'طلب ملغى' </span> </td>
                                @elseif($order -> status == 13)
                                    <td><span class="badge badge-Success">'طلب مكتمل' </span> </td>
                                @endif
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>



        <div class="apps drivers my-5">
            <h2 class="mb-4"> تطبيق mona </h2>
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
                            <th> السائق </th>
                            <th> الدفع </th>
                            <th> </th>
                        </tr>
                        </thead>
                        <tbody>

                        <tr>
                        @foreach($monas->orders as $order)
                            <tr>
                                <td>{{$order->id ?? '--'}}</td>
                                <td>{{$order->order_date ?? '--'}} </td>
                                <td> {{$order->order_type ?? '--'}}</td>
                                <td> {{$order->distributor->full_name ?? 'wash'}}</td>
                                <td> {{$order->number_of_cars ?? '--'}}</td>
                                <td> {{$order->service_id ?? '--'}}</td>
                                <td>{{($order->sub_service_id) ?? '--'}}</td>
                                <td>{{$order->sub_type_id ?? '--'}}</td>
                                <td>{{$order->place_id ?? '--'}}</td>
                                <td>{{$order->user->name ?? '--'}}</td>
                                <td>{{$order->user->phone ?? '--'}}</td>

                                <td>   {{$order->total_price ?? '--'}}</td>
                                <td> {{$order->driver_id ?? '--'}} </td>

                                <td>  {{$order->id ?? '--'}}</td>


                                @if($order -> status == 1)
                                    <td><span class="badge badge-info">'طلب جديد'</span> </td>
                                @elseif($order -> status == 5)
                                    <td><span class="badge badge-danger">'طلب ملغى' </span> </td>
                                @elseif($order -> status == 13)
                                    <td><span class="badge badge-Success">'طلب مكتمل' </span> </td>
                                @endif
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <div class="apps drivers my-5">
            <h2 class="mb-4"> تطبيق الجوهرة </h2>
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
                            <th> السائق </th>
                            <th> الدفع </th>
                            <th> </th>
                        </tr>
                        </thead>
                        <tbody>

                        <tr>
                        @foreach($gawharahs->orders as $order)
                            <tr>
                                <td>{{$order->id ?? '--'}}</td>
                                <td>{{$order->order_date ?? '--'}} </td>
                                <td> {{$order->order_type ?? '--'}}</td>
                                <td> {{$order->distributor->full_name ?? 'wash'}}</td>
                                <td> {{$order->number_of_cars ?? '--'}}</td>
                                <td> {{$order->service_id ?? '--'}}</td>
                                <td>{{($order->sub_service_id) ?? '--'}}</td>
                                <td>{{$order->sub_type_id ?? '--'}}</td>
                                <td>{{$order->place_id ?? '--'}}</td>
                                <td>{{$order->user->name ?? '--'}}</td>
                                <td>{{$order->user->phone ?? '--'}}</td>

                                <td>   {{$order->total_price ?? '--'}}</td>
                                <td> {{$order->driver_id ?? '--'}} </td>

                                <td>  {{$order->id ?? '--'}}</td>



                                @if($order -> status == 1)
                                    <td><span class="badge badge-info">'طلب جديد'</span> </td>
                                @elseif($order -> status == 5)
                                    <td><span class="badge badge-danger">'طلب ملغى' </span> </td>
                                @elseif($order -> status == 13)
                                    <td><span class="badge badge-Success">'طلب مكتمل' </span> </td>
                                @endif
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <div class="apps drivers my-5">
            <h2 class="mb-4"> تطبيق لمى </h2>
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
                            <th> السائق </th>
                            <th> الدفع </th>
                            <th> </th>
                        </tr>
                        </thead>
                        <tbody>

                        <tr>
                        @foreach($lamas->orders as $order)
                            <tr>
                                <td>{{$order->id ?? '--'}}</td>
                                <td>{{$order->order_date ?? '--'}} </td>
                                <td> {{$order->order_type ?? '--'}}</td>
                                <td> {{$order->distributor->full_name ?? 'wash'}}</td>
                                <td> {{$order->number_of_cars ?? '--'}}</td>
                                <td> {{$order->service_id ?? '--'}}</td>
                                <td>{{($order->sub_service_id) ?? '--'}}</td>
                                <td>{{$order->sub_type_id ?? '--'}}</td>
                                <td>{{$order->place_id ?? '--'}}</td>
                                <td>{{$order->user->name ?? '--'}}</td>
                                <td>{{$order->user->phone ?? '--'}}</td>

                                <td>   {{$order->total_price ?? '--'}}</td>
                                <td> {{$order->driver_id ?? '--'}} </td>

                                <td>  {{$order->id ?? '--'}}</td>



                                @if($order -> status == 1)
                                    <td><span class="badge badge-info">'طلب جديد'</span> </td>
                                @elseif($order -> status == 5)
                                    <td><span class="badge badge-danger">'طلب ملغى' </span> </td>
                                @elseif($order -> status == 13)
                                    <td><span class="badge badge-Success">'طلب مكتمل' </span> </td>
                                @endif
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <div class="apps drivers my-5">
            <h2 class="mb-4"> تطبيق حراج </h2>
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
                            <th> السائق </th>
                            <th> الدفع </th>
                            <th> </th>
                        </tr>
                        </thead>
                        <tbody>

                        <tr>
                        @foreach($herags->orders as $order)
                            <tr>
                                <td>{{$order->id ?? '--'}}</td>
                                <td>{{$order->order_date ?? '--'}} </td>
                                <td> {{$order->order_type ?? '--'}}</td>
                                <td> {{$order->distributor->full_name ?? 'wash'}}</td>
                                <td> {{$order->number_of_cars ?? '--'}}</td>
                                <td> {{$order->service_id ?? '--'}}</td>
                                <td>{{($order->sub_service_id) ?? '--'}}</td>
                                <td>{{$order->sub_type_id ?? '--'}}</td>
                                <td>{{$order->place_id ?? '--'}}</td>
                                <td>{{$order->user->name ?? '--'}}</td>
                                <td>{{$order->user->phone ?? '--'}}</td>

                                <td>   {{$order->total_price ?? '--'}}</td>
                                <td> {{$order->driver_id ?? '--'}} </td>

                                <td>  {{$order->id ?? '--'}}</td>



                                @if($order -> status == 1)
                                    <td><span class="badge badge-info">'طلب جديد'</span> </td>
                                @elseif($order -> status == 5)
                                    <td><span class="badge badge-danger">'طلب ملغى' </span> </td>
                                @elseif($order -> status == 13)
                                    <td><span class="badge badge-Success">'طلب مكتمل' </span> </td>
                                @endif
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

@endsection
  @section('js')
<script>


        $('#changeFilter').on('change',function(){
        var val = $(this).val();
        var myUrl = "{{route('admin.FinancialOrderReports')}}?month={{date('Y-m')}}&type=filter&filter="+val
        window.location = myUrl
    });
</script>

        <script>
        $('#choseMonth-change').on('keyup keydown change', function(){
        var val = $(this).val();
       // alert('mohamed')
        var myUrl = "{{route('admin.FinancialOrderReports')}}?month="+val+"&type=month";
        window.location = myUrl
    });
</script>







@endsection

