<div class="row">
    <div class="col-md-2 text-center p-1">
        <div class="w-100 d-flex justify-content-center mb-2">
            <img src="{{url('assets/admin/images/Group 61.png')}}" width="50px" alt="">
        </div>
        <p> الإشتراكات </p>
    </div>
    <div class="col-md-10 row p-1">
        <div class="col-md-3 text-center p-1">
            <h5 style="color: #3f0033;"> سعر الباقة </h5>
            <p class="pt-2"> SR {{$order->total_price}} </p>
        </div>
        <div class="col-md-3 text-center p-1">
            <h5 style="color: #3f0033;"> تاريخ البداية </h5>
            @if(count($order->wash_sub))
                <p class="pt-2"> {{$order->wash_sub[0]->status=='wait'?$order->wash_sub[0]->will_wash_date:$order->wash_sub[0]->wash_date}} </p>
            @endif
        </div>
        <div class="col-md-3 text-center p-1">
            <h5 style="color: #3f0033;"> اليوم </h5>
            <p class="pt-2"> {{$day}}  </p>
        </div>
        <div class="col-md-3 text-center p-1">
            <h5 style="color: #3f0033;"> المتبقي </h5>
            <p class="pt-2"> {{$leftWashes}} غسلة </p>
        </div>
    </div>
</div>
<h3 class="wash-detail"> تفاصيل الغسلات </h3>
<div class="table-rep-plugin">
    <div class="table-responsive mb-0 rounded" data-pattern="priority-columns">
        <table id="tech-companies-1" class="table table-striped">
            <thead>
            <tr class="mo-tr">
                <th> رقم الغسلة</th>
                <th> تاريخ الغسلة</th>
                <th> اليوم</th>
                <th> حالة الغسلة</th>
            </tr>
            </thead>
            <tbody>
            @foreach($order->wash_sub as $wash)
                <tr>
                    <td>الغسلة {{$wash->number_of_wash}}</td>
                    <td> {{$wash->status == 'wait'?$wash->will_wash_date:$wash->wash_date}} </td>
                    <td> @php
                        $washDate = $wash->status == 'wait'?$wash->will_wash_date:$wash->wash_date;
                        $dayWash = $days[date('D', strtotime($washDate))];
                        @endphp
                        {{$dayWash}}
                    </td>
                    <td>
                        @if($wash->status == 'done')
                            <i class="fas fa-check-circle pe-1 " style="color:#9CDD9A"></i> تمت الخدمة
                        @else
                            مجدولة
                        @endif
                    </td>
                </tr>
            @endforeach


            </tbody>
        </table>
    </div>
</div>
