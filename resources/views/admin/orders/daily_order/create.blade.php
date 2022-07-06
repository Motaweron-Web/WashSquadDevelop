<h3 style="color: #7D349D  ; text-align: center;">توزيع الطلبات اليومية </h3>
<form action="{{route('dailyOrderDistributionStore')}}" id="DistributionForm">
    <div class="mod-content d-block mt-3">
        @csrf
        <div class="row pt-4">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label" for="default-input"> إختر اليوم
                    </label>
                    <input class="form-control" name="day" id="day" type="date" value="{{date('Y-m-d')}}" required
                           placeholder="">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 p-2">
                <p class="form-label"> مواقع التغطية </p>
            </div>
            <div class="col-md-3 p-2">
                <p class="form-label"> عدد السيارات</p>
            </div>
            <div class="col-md-5 p-2">
                <p class="form-label"> اختر السائق </p>
            </div>
        </div>

        @foreach($places_groups as $place)
            <div class="row align-items-center" id="row{{$place->id}}">
                <div class="col-md-4 p-2">
                    <div class="d-flex p-1 px-3 justify-content-between align-items-center mo-form-select">
                        <p class="mb-0"> {{$place->name}} </p>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" data-group_id="{{$place->id}}" name="group_id[]" value="{{$place->id}}">
                        </div>
                    </div>
                </div>
                <div class="col-md-3 p-2">
                    <div class="number">
                        <span class="minus" id="minus{{$place->id}}" data-id="{{$place->id}}">-</span>
                        <input class="count numbersOnly carCount" data-id="{{$place->id}}" id="carCount{{$place->id}}"
                               type="number" min="1" value="1">
                        <span class="plus" id="plus{{$place->id}}" data-id="{{$place->id}}">+</span>
                    </div>
                </div>
                <div class="col-md-5 p-2">
                    <div class="times  p-0">
                        <!-- driver -->
                        <div id="driver" class="driver days flex-wrap m-0">
                            <select class="form-select" id="option-data" name="{{$place->id}}_user_id[]">
                                @foreach($drivers as $driver)
                                    <option value="{{$driver->id}}" > {{$driver->name}}</option>
                                @endforeach
                            </select>
                            {{--                        <div id="addDriver" class="add addDriver" data-id="{{$place->id}}">--}}
                            {{--                            <i class="fas fa-plus-circle"></i>--}}
                            {{--                        </div>--}}
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        {{--        <div class="row">--}}
        {{--            @foreach($places as $place)--}}
        {{--                <div class="col-md-12 mb-2 d-flex justify-content-center">--}}
        {{--                    <div class="col-md-4 ">--}}
        {{--                        <div class="mb-3 ">--}}
        {{--                            <div--}}
        {{--                                class="d-flex p-1 rounded justify-content-between align-items-center mo-form-select">--}}
        {{--                                <p class="mb-0"> وسط الرياض </p>--}}
        {{--                                <div class="form-check form-switch">--}}
        {{--                                    <input class="form-check-input" name="place_id[]" value="{{$place->id}}"--}}
        {{--                                           type="checkbox"--}}
        {{--                                           id="flexSwitchCheckDefault">--}}
        {{--                                </div>--}}
        {{--                            </div>--}}
        {{--                        </div>--}}
        {{--                    </div>--}}
        {{--                    <div class="col-md-8 ">--}}
        {{--                        <div class="row">--}}
        {{--                        @foreach($services as $service)--}}

        {{--                                <div class="mb-3 col-md-3 d-flex justify-content-center px-1">--}}
        {{--                                    <div class="number">--}}
        {{--                                        <span class="minus minusDaily">-</span>--}}
        {{--                                        <input class="count" name="count_{{$place->id}}[{{$service->id}}]" type="text"--}}
        {{--                                               value="1"/>--}}
        {{--                                        <span class="plus plusDaily">+</span>--}}
        {{--                                    </div>--}}
        {{--                                </div>--}}

        {{--                        @endforeach--}}
        {{--                        </div>--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--            @endforeach--}}
        {{--        </div>--}}
    </div>
    <div class="modal-footer ">
        <div class="w-100 d-flex justify-content-end">
            <button type="submit" id="mySaveBtn" class="btn orangeBtn"> حفط</button>
            <button type="button" class="btn stoped  mx-2" data-bs-dismiss="modal">
                إلغاء
            </button>
        </div>
    </div>
</form>
<script>
    $(document).ready(function () {
        // add new select driver
        function appendDriverSelect(row_id, addOrSub) {
            var options_data = $('#option-data').html();
            var driverSelect = `
                <select class="form-select" id="option-data" name="${row_id}_user_id[]">
                    ${options_data}
                </select>
            `;
            if (addOrSub === 'add')
                $('#row' + row_id + ' #driver').prepend(driverSelect);
            else if (addOrSub === 'sub') {
                $('#row' + row_id + ' #driver #option-data:last').remove();
            }
        }

        // plus and minus buttons
        $('.minus').on('click', function () {
            var spanNumber = $('#carCount' + $(this).attr('data-id'));
            if (spanNumber.val() == 1)
                toastr.error('يجب ان لا يقل عدد السيارات عن 1');
            else {
                appendDriverSelect($(this).attr('data-id'), 'sub');
                spanNumber.val(parseInt(spanNumber.val()) - 1);
            }
        });
        $('.plus').on('click', function () {
            appendDriverSelect($(this).attr('data-id'), 'add');
            var spanNumber = $('#carCount' + $(this).attr('data-id'));
            spanNumber.val(parseInt(spanNumber.val()) + 1);
        });
        $('.carCount').on('focusout', function () {
            if (this.value >= 1) {
                $(this).parent().parent().parent().find('#driver').empty()
                var i;
                for (i = 0; i <= this.value - 1; i++) {
                    appendDriverSelect($(this).attr('data-id'), 'add')
                }
            } else {
                $(this).val($(this).parent().parent().parent().find('#driver #option-data').length);
                toastr.error('يجب ان لا يقل عدد السيارات عن 1');
            }
        });
    });


    // submit the form
    $(document).on('submit', 'form#DistributionForm', function (e) {
        e.preventDefault();
        // var driver_id = [];
        // var day = $('#day').val();
        // var group_id = $("input[name='group_id[]']")
        // var url = $(this).attr('action');
        // $.each( group_id, function( key, value ) {
        //
        //     $.each($(this).parent().parent().parent().parent().find('#option-data'),function(key,val){
        //         // driver_id.push($(this).val())
        //         e = $(this).val();
        //     });
        //     console.log(e)
        //
        // });
        // console.log(driver_id)
        var formData = new FormData(this);
        var url = $(this).attr('action');
        $.ajax({
            url: url,
            type: 'POST',
            data:formData,
            beforeSend: function () {
                $('#mySaveBtn').html('<span style="margin-left: 4px;">انتظر...<span class="spinner-border spinner-border-sm mr-2" ' +
                    ' ></span> </span>').attr('disabled', true);
            },
            complete: function () {
                $('#mySaveBtn').html('<span>حفظ</span>').attr('disabled', false);
            },
            success: function (data) {
                if (data.status == 200) {
                    toastr.success(data.message);
                    $('#createOrUpdateModal').modal('hide')
                } else {
                    toastr.error('حدث خطأ غير متوقع يرجي اعادة المحاولة');
                }
            },
            error: function (data) {
                if (data.status === 500) {
                    toastr.error('حدث خطأ غير متوقع يرجي اعادة المحاولة');
                } else if (data.status === 422) {
                    var errors = $.parseJSON(data.responseText);
                    $.each(errors, function (key, value) {
                        if ($.isPlainObject(value)) {
                            $.each(value, function (key, value) {
                                $('input[name=' + key + ']').css('border', '1px solid red')
                                $('select[name=' + key + ']').css('border', '1px solid red')
                                toastr.error(value);
                            });
                        }
                    });
                } else if (data.status === 423) {
                    var errors = $.parseJSON(data.responseText);
                    $.each(errors, function (key, value) {
                        if ($.isPlainObject(value)) {
                            $.each(value, function (key, value) {
                                toastr.error(value);
                            });
                        }
                    });
                } else {
                    $('#mySaveBtn').html('<span>حفظ</span>').attr('disabled', false);
                    toastr.error('حدث خطأ غير متوقع يرجي اعادة المحاولة');
                }
            },//end error method

            cache: false,
            contentType: false,
            processData: false
        });
    });

</script>
