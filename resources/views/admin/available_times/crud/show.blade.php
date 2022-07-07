
<div class="mod-content " id="mod-content-form">


        <div class="row pt-4">
            <div class="col-md-6">
                <div class="mb-3 " >
                    <label class="form-label" for="default-input"> إسم العميل
                    </label>
                    <input class="form-control " disabled name="full_name" value="{{$order->user->full_name??''}}" type="text" id="default-input"
                           placeholder="">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label" for="default-input">رقم الجوال</label>
                    <input class="form-control numbersOnly" disabled name="phone" value="{{$order->user->phone??''}}" type="text" id="default-input"
                           placeholder="">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label" for="default-input"> الحي </label>
                    <select class="form-select mo-form-select" disabled  name="place_id" id="">
                        <option value="" selected disabled>الحي</option>
                        @foreach($places as $place)
                            <option value="{{$place->id}}" {{$place->id == $order->place_id?'selected':''}}>{{$place->title_ar}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label" for="default-input"> تاريخ الطلب
                    </label>
                    <input class="form-control" name="order_date" disabled value="{{$order->date}}" type="date" id="default-input"
                           placeholder="">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label" for="default-input"> وقت الطلب
                    </label>
                    <input class="form-control" name="order_time" disabled value="{{$order->order_time}}" type="time" id="default-input"
                           placeholder="">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label" for="default-input"> وسيلة الدفع
                    </label>
                    <select class="form-select mo-form-select" disabled name="payment_method" id="">
                        <option value="" selected disabled>وسيلة الدفع</option>
                        <option value="2" {{$order->payment_method==2?'selected':''}}>كاش</option>
                        <option value="3" {{$order->payment_method==3?'selected':''}}>نقطة البيع</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label" for="default-input"> ماركة السيارة
                    </label>
                    <select class="form-select mo-form-select" disabled id="selectCarType" name="type_id">
                        <option value="" selected disabled>ماركة السيارة</option>
                        @foreach($carTypes as $carType)
                            <option value="{{$carType->id}}" {{$carType->id == $order->type_id?'selected':''}}>{{$carType->ar_title}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label" for="default-input"> الفئة </label>
                    <select class="form-select mo-form-select" disabled name="sub_type_id" id="sub_type_id">
                        <option value="" selected disabled>إختر الماركة أولا</option>
                        @foreach($order->type->sub_types??[] as $subType)
                            <option value="{{$subType->id}}" data-size="{{$subType->size}}" {{$subType->id == $order->sub_type_id?'selected':''}}>{{$subType->ar_title}}</option>
                        @endforeach
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
                        <input class="count numbersOnly" name="number_of_cars" disabled value="{{$order->number_of_cars??0}}" id="number_of_cars" type="text" />
                        <span class="plus">+</span>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label" for="default-input">الإجمالى
                    </label>
                    <input class="form-control numbersOnly" id="price_total" value="{{$order->price_total}}" disabled name="price_total" type="text"
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
