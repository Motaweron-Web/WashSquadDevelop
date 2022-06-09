@foreach($orders as $order)
    @php
    $class ='';
    if ($order->service_id == 2){
        $class = 'purble';
    }elseif ($order->service_id == 1){
        $class = 'yelo';
    }elseif ($order->service_id == 78){
        $class = 'gry';
    }elseif ($order->service_id == 77){
        $class = 'blu';
    }elseif ($order->service_id == 79){
        $class = 'gren';
    }
    $firstSubServiceTitle = '';
    $subServiceOrder = App\Models\SubServiceOrder::where('order_id',$order->id)->with('service');
    if($subServiceOrder->count()){
            $firstSubServiceTitle = $subServiceOrder->get()[0]->service->ar_title;
    }
    @endphp
    <tr class="{{$class}} big-border-p text-white">
        <td> {{$order->id}}</td>
        <td> {{$order->date}}</td>
        <td> {{$order->order_time}}</td>
        <td> wash</td>
        <td> {{$order->number_of_cars}}</td>
        <td>{{$order->service_basic->ar_title??''}}</td>
        <td>{{$order->service_basic->ar_title??''}}</td>
        <td>{{$firstSubServiceTitle}}</td>
        <td> {{$order->place->title_ar??''}}</td>
        <td>{{$order->user->full_name??''}}</td>

        <td> {{$order->user->phone_code??''}}{{$order->user->phone??''}}</td>
        <td>{{$order->type->ar_title??''}}</td>
        <td>{{$order->total_price??0}}</td>
        <td>
            <select class="form-select chooseDriver" data-id="{{$order->id}}">
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
            <i class="dripicons-information px-1 informationData" data-url="{{route('orders.showInformation',$order->id)}}"></i>
            <i class="far fa-edit px-1 editOrder" data-id="{{$order->id}}"></i>
            <i class="far fa-trash-alt text-danger px-1 deleteBtn" data-id="{{$order->id}}"></i>
        </td>
    </tr>

@endforeach
