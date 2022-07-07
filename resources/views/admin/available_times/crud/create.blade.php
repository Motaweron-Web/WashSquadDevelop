
<div class="mod-content " id="mod-content-form">
    <form action="{{route('orders.store')}}" id="Form" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="order_time_id" value="27">

        <div class="row pt-4">
            <div class="col-md-6">
                <div class="mb-3 " >
                    <label class="form-label" for="default-input"> إسم العميل
                    </label>
                    <input class="form-control " name="full_name" type="text" id="default-input"
                           placeholder="">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label" for="default-input">رقم الجوال</label>
                    <input class="form-control numbersOnly" name="phone"  type="text" id="default-input"
                           placeholder="">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label" for="default-input"> الحي </label>
                    <select class="form-select mo-form-select"  name="place_id" id="">
                        <option value="" selected disabled>الحي</option>
                        @foreach($places as $place)
                            <option value="{{$place->id}}">{{$place->ar_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label" for="default-input"> تاريخ الطلب
                    </label>
                    <input class="form-control" name="order_date" type="date" id="default-input"
                           placeholder="">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label" for="default-input"> وقت الطلب
                    </label>
                    <input class="form-control" name="order_time" type="time" id="default-input"
                           placeholder="">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label" for="default-input"> وسيلة الدفع
                    </label>
                    <select class="form-select mo-form-select" name="payment_method" id="">
                        <option value="" selected disabled>وسيلة الدفع</option>
                        <option value="2">كاش</option>
                        <option value="3">نقطة البيع</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label" for="default-input"> ماركة السيارة
                    </label>
                    <select class="form-select mo-form-select" id="selectCarType" name="type_id">
                        <option value="" selected disabled>ماركة السيارة</option>
                        @foreach($carTypes as $carType)
                            <option value="{{$carType->id}}">{{$carType->ar_title}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label" for="default-input"> الفئة </label>
                    <select class="form-select mo-form-select" name="sub_type_id" id="sub_type_id">
                        <option value="" selected disabled>إختر الماركة أولا</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label" for="default-input"> نوع الخدمة
                    </label>
                    <select class="form-select mo-form-select" name="service_id" id="service_id">
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
                        <span class="minus minusOrder">-</span>
                        <input class="count numbersOnly" name="number_of_cars" id="number_of_cars" type="text" value="0" />
                        <span class="plus placeOrder">+</span>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label" for="default-input">الإجمالى
                    </label>
                    <input class="form-control numbersOnly" id="price_total" readonly value="" name="price_total" type="text"
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
    </form>
</div>
<script>
    // Show Governorates
    var types = JSON.parse('<?php echo json_encode($carTypes) ?>');

    $(document).on('change', '#selectCarType', function () {
        var id = $(this).val();
        var type = types.filter(oneObject => oneObject.id == id)
        if (type.length > 0) {
            var subTypes = type[0].sub_types

            $('#sub_type_id').html('<option value="">إختر الفئة</option>')

            $.each(subTypes, function (index) {
                $('#sub_type_id').append('<option data-size="'+subTypes[index].size+'" value="' + subTypes[index].id + '">' + subTypes[index].ar_title + '</option>')
            })
        }
    })
</script>
