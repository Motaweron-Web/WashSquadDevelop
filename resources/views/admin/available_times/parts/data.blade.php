<!--  -->
<div class="row mb-3">
    <div class="col-md-2 p-2">
        <select class="form-select shadow-lg filterByPlace">
            <option selected="" value=""> اختر الحي (الكل)</option>
            @foreach ($groups as $group)
                <option value="{{$group->name}}">{{$group->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4 p-2">
        <div class="input-group shadow-lg">
            <input type="search" class="form-control searchInput filterByPlace" aria-describedby="searchLabel">
        </div>
    </div>
</div>
<!-- times -->
<div class="timesAvailable">
    <table id="available-times-table" class="table table-borderless">
        <thead>
        <tr>
            <td></td>
            @foreach($periods as $period)
                <td>
                    <div class="time">
                        <p> {{$period->period_title}} {{$period->en_period_type}} </p>
                        <i class="far fa-clock    "></i>
                    </div>
                </td>
            @endforeach

        </tr>
        </thead>
        <tbody>
        @foreach ($groups as $group)
            <tr>
                <td>
                    <p class="area">{{$group->name}}</p>
                </td>
                @foreach($periods as $period)
                    @php
                        $html='  <td>
                                           <div class="serviceTime wait">
                                               <div class="services">
                                                   <div class="service">
                                                       <div class="count">
                                                           0
                                                       </div>
                                                       <p> غسيل </p>
                                                   </div>
                                                   <div class="service">
                                                       <div class="count">
                                                           0
                                                       </div>
                                                       <p> تلميع </p>
                                                   </div>
                                                   <div class="service">
                                                       <div class="count">
                                                           0
                                                       </div>
                                                       <p> تعقيم </p>
                                                   </div>
                                                   <div class="service waitService">
                                                    <div class="count">
                                                        0
                                                    </div>
                                                    <p> انتظار </p>
                                                </div>
                                               </div>
                                           </div>
                                       </td>';

                           $selectRow = \App\Models\GroupPeriod::where('group_id', $group->id)->where('period_id',$period->id)->first();
                           if ($selectRow){

                            $polishing = \App\Models\Order::where('date',$id)->where('service_id',2)->sum('number_of_cars');
                            $wash = \App\Models\Order::where('date',$id)->where('service_id',1)->sum('number_of_cars');
                            $sterilization = \App\Models\Order::where('date',$id)->where('service_id',78)->sum('number_of_cars');

                            $polishingLimit = \App\Models\PeriodLimit::where('service_id',2)->sum('count');
                            $washLimit = \App\Models\PeriodLimit::where('service_id',1)->sum('count');
                            $sterilizationLimit = \App\Models\PeriodLimit::where('service_id',78)->sum('count');

                            $class = '';

                           $remWash = $washLimit- $wash;
                           $remPolishing = $polishingLimit- $polishing;
                           $remSterilization = $sterilizationLimit- $sterilization;

                            if($remWash <=0&& $remPolishing <=0&& $remSterilization <=0){
                                $class = ' wait';
                            }


                              $html='  <td>
                                           <div class="serviceTime'.$class.'">
                                               <div class="services">
                                                   <div class="service">
                                                       <div class="count">
                                                           '.$remWash.'
                                                       </div>
                                                       <p> غسيل </p>
                                                   </div>
                                                   <div class="service">
                                                       <div class="count">
                                                           '.$remPolishing.'
                                                       </div>
                                                       <p> تلميع </p>
                                                   </div>
                                                   <div class="service">
                                                       <div class="count">
                                                           '.$remSterilization.'
                                                       </div>
                                                       <p> تعقيم </p>
                                                   </div>
                                               </div>
                                               <div class="event">
                                                   <i class="fas fa-plus-circle" data-bs-toggle="modal"
                                                       data-bs-target="#newOrder"></i>
                                               </div>
                                           </div>
                                       </td>';
                           }
                    @endphp
                    {!! $html !!}
                @endforeach

            </tr>
        @endforeach

        </tbody>
    </table>
</div>
