@extends('admin.layouts.inc.app')


@section('content')

    <!-- breadcrumb -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item"> <a href="{{route('showperiods')}}"> الاوقات </a> </li>
            <li class="breadcrumb-item active"> <a href="#!"> </a> إضافة فترة </li>
        </ol>
        <button class="btn btn-dark" onclick="history.back()"> عودة </button>
    </div>
    <!-- end breadcrumb -->
    <!-- edit Service -->
    <section class="editService">
        <form action="{{route('updatetime',$period->id)}}" method="post" >
            @csrf
            <div class="row">
                <div class="col-md-4 p-2">
                    <label class="form-label"> ساعة بداية الفترة </label>
                    <select name="starttime" class="form-select">
                        @for($i=1;$i<=12;$i++)
                            <option  @if(explode("-",$period->period_title)[0]==$i) selected @endif value="{{$i}}"> {{$i}}</option>

                        @endfor
                    </select>
                </div>
                <div class="col-md-4 p-2">
                    <label class="form-label"> ساعة نهاية الفترة </label>
                    <select name="endtime" class="form-select">
                        @for($i=1;$i<=12;$i++)
                            <option  @if(explode("-",$period->period_title)[1]==$i) selected @endif value="{{$i}}"> {{$i}}</option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-4 p-2">
                    <label class="form-label"> النوع </label>
                    <select name="timetype" class="form-select">
                        <option @if($period->en_period_type=='PM') selected @endif value="2"> مساءا </option>
                        <option @if($period->en_period_type=='AM') selected @endif value="1"> صباحا </option>
                    </select>
                </div>
            </div>
            <!-- time orders -->
            <h5 class="p-3 pt-5"> عدد طلبات الفترة </h5>
            <div class="d-flex">
                @foreach($services as $service)
                    @if($service->ar_title=='تلميع')

                        @foreach($sizes as $size)

                            <div class="text-center ">
                                <label class="form-label">{{$service->ar_title}} {{$size->ar_title}} </label>
                                <div class="number ms-4">
                                    <span class="minus">-</span>
                                    <input class="count"  value="{{$periodlimits->where('size_id',$size->id)->where('type','main')->first()->count??0}}" name="talmeecount[]" type="text"  />
                                    <span class="plus">+</span>
                                </div>
                            </div>

                        @endforeach
                    @else
                        <div class="text-center ">
                            <label class="form-label">{{$service->ar_title}} </label>
                            <div class="number ms-4">
                                <span class="minus">-</span>
                                <input class="count" value="{{$periodlimits->where('service_id',$service->id)->where('type','main')->first()->count??0}}" name="servicecount[]" type="text"  />
                                <span class="plus">+</span>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            <!-- end time orders -->
            <!-- wait orders -->
            <h5 class="p-3 pt-5"> طلبات الانتظار الفترة </h5>
            <div class="d-flex">
                @foreach($services as $service)
                    @if($service->ar_title=='تلميع')

                        @foreach($sizes as $size)

                            <div class="text-center ">
                                <label class="form-label">{{$service->ar_title}} {{$size->ar_title}} </label>
                                <div class="number ms-4">
                                    <span class="minus">-</span>
                                    <input class="count"  name="waittalmeecount[]" type="text" value="{{$periodlimits->where('size_id',$size->id)->where('type','wait')->first()->count??0}}" />
                                    <span class="plus">+</span>
                                </div>
                            </div>

                        @endforeach
                    @else
                        <div class="text-center ">
                            <label class="form-label">{{$service->ar_title}} </label>
                            <div class="number ms-4">
                                <span class="minus">-</span>
                                <input class="count" name="waitservicecount[]" type="text" value="{{$periodlimits->where('service_id',$service->id)->where('type','wait')->first()->count??0}}" />
                                <span class="plus">+</span>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            <!-- end wait orders -->
            <div class="text-end py-2">
                <button type="submit" class="btn orangeBtn"> حفظ و إغلاق </button>
            </div>
        </form>
    </section>
    <!-- end edit Service -->



@endsection


@section('style')


@endsection

@section('js')

    <script>
        @if($errors->any())
        toastr.error('يرحي التاكد من البيانت المدخلة');
        @endif


    </script>

@endsection
