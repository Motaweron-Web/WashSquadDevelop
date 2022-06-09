<div class="mod-content" id="mod-content-form">
    <form action="{{route('orders.dailyOrder.save')}}" id="Form" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row pt-4">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label" for="default-input"> إختر اليوم
                    </label>
                    <input class="form-control" name="date" type="date" id="default-input"
                           placeholder="بكري">
                </div>
            </div>
            <div class="col-md-3">
                <div class="mb-3">
                    <label class="form-label" for="default-input"> ساعات العمل من
                    </label>
                    <input class="form-control" name="from" type="time" id="default-input"
                           placeholder="213243">
                </div>
            </div>
            <div class="col-md-3">
                <div class="mb-3">
                    <label class="form-label" for="default-input"> إلى </label>
                    <input class="form-control" name="to" type="time" id="default-input"
                           placeholder="213243">
                </div>
            </div>
            <div class="col-md-12 row">
                <div class="col-md-6">
                    <p class="form-label" for="default-input"> مواقع التغطية
                    </p>
                </div>
                <div class="col-md-6 d-flex justify-content-between">
                    @foreach($services as $service)
                        <p class="form-label" style="font-size: 11px;"
                           for="default-input">{{$service->ar_title}}
                        </p>
                    @endforeach
                </div>
            </div>
            @foreach($places as $place)
            <div class="row col-md-12 mb-2 d-flex justify-content-center">
                <div class="col-md-6 ">
                    <div class="mb-3 ">
                        <div
                            class="d-flex p-1 rounded justify-content-between align-items-center mo-form-select">
                            <p class="mb-0"> وسط الرياض </p>
                            <div class="form-check form-switch">
                                <input class="form-check-input" name="place_id[]" value="{{$place->id}}" type="checkbox"
                                       id="flexSwitchCheckDefault">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 row ">
                    @foreach($services as $service)
                        <div class="mb-3 col-md-3 d-flex justify-content-center px-1">
                            <div class="number">
                                <span class="minus minusDaily">-</span>
                                <input class="count" name="count_{{$place->id}}[{{$service->id}}]" type="text" value="1"/>
                                <span class="plus plusDaily">+</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
    </form>
</div>
