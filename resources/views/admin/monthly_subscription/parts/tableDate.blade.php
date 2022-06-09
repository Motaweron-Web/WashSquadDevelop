@foreach($orders as $order)
    @php

    $firstSubServiceTitle = '';
    $subServiceOrder = App\SubServiceOrder::where('order_id',$order->id)->with('service');
    if($subServiceOrder->count()){
            $firstSubServiceTitle = $subServiceOrder->get()[0]->service->ar_title;
    }
    @endphp
    <tr class="blu big-border-p text-white">
        <td> {{$order->id}} </td>
        <td> {{$order->date}} </td>
        <td> {{$order->order_time}} </td>
        <td> wash </td>
        <td> {{$order->number_of_cars}} </td>
        <td>{{$order->service_basic->ar_title??''}}</td>
        <td>{{$order->service_basic->ar_title??''}}</td>
        <td>{{$firstSubServiceTitle}}</td>
        <td> {{$order->place->title_ar??''}}</td>
        <td>{{$order->user->full_name??''}}</td>
        <td> {{$order->user->phone_code??''}}{{$order->user->phone??''}}</td>
        <td>{{$order->type->ar_title??''}}</td>
        <td>{{$order->total_price??0}}</td>
        <td> <a href="https://maps.google.com/?q={{$order->latitude}},{{$order->longitude}}" target="_blank"> <i class="fas fa-map-marker-alt"></i> </a>
        </td>
        <td> <a href="{{url("api/order/print/$order->id")}}" target="_blank"> <i class="fas fa-file-pdf"></i> </a> </td>
        <td> <button class="sub-details" data-url="{{route('monthly-subscription.edit',$order->id)}}" > تفاصيل الإشتراك </button> </td>
    </tr>

@endforeach
