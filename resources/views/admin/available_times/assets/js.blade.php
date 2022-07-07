
<script>

    var loaderHtml = '<div style="text-align: center;"><div class="lds-grid"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></div>';

    loadDay("{{date('Y-m-d')}}",false)

    $(document).on('click','.getData',function (e) {
        e.preventDefault();
        var date = $(this).data('date');
        // console.log(date);
        loadDay(date,true)
    });

    function loadDay(date,ifReload) {
        var url = "{{route('available-times.show',':date')}}";
        url = url.replace(':date',date)
        $('.spinner').show()
        $('#bodyToLoad').html('')

        $.get(url,function (data) {
            $('#loadData').html(data.html)
        })
        setTimeout(function(){
            $('.spinner').hide()
        },500)

        $('.getData').removeClass('active')
        $('.'+date).addClass('active')
        $('.{{date('Y-m-d')}}').addClass('toDay')


        if (date == "{{date('Y-m-d')}}"){
            $('.{{date('Y-m-d')}}').removeClass('toDay')
        }
    }
    $('#choseMonth').on('keyup keydown change', function(){
        var val = $(this).val()
        changeMonth(val)
    });
     function changeMonth(val){
        var newUrl = "{{route('available-times.index')}}?month="+val;
        $.ajax({
            url:"{{route('available-times.anotherMonth.index')}}?month="+val,
            type: 'GET',
            beforeSend: function(){
                $('.spinner').show()
            },
            complete: function(){
                setTimeout(function () {
                    $('.spinner').hide()
                },500)

            },
            success: function (data) {
                if (data.status == 200){
                    // console.log(data.html)
                    $('.calender').html(data.html)
                    window.history.pushState({path:newUrl},'',newUrl);
                }else {
                    window.location = "{{route('available-times.index')}}?month={{date('Y-m')}}"
                }



            },
            error: function (data) {
                toastr.error('هناك خطأ ما');
            },//end error method

            cache: false,
            contentType: false,
            processData: false
        });
    }
    $('.create-btn').on('click',function(){
        $('#createOrUpdateContent').html(loaderHtml)
        $('#createOrUpdateModal').modal('show')
        var url = $(this).data('url')
        setTimeout(function () {
            $('#createOrUpdateContent').load(url)
        },500)

    });


    $(document).ready(function() {
        $(document).on('click','.minusOrder',function () {
            var $input = $(this).parent().find('input');
            var count = parseInt($input.val()) - 1;
            count = count < 1 ? 1 : count;
            $input.val(count||0);
            $input.change();
            changeCount();
            return false;
        });
        $(document).on('click','.placeOrder',function () {
            var $input = $(this).parent().find('input');
            $input.val(parseInt($input.val()) + 1);
            $input.change();
            changeCount();
            return false;
        });
        $(document).on('click','.minusDaily',function () {
            var $input = $(this).parent().find('input');
            var count = parseInt($input.val()) - 1;
            count = count < 1 ? 1 : count;
            $input.val(count||0);
            $input.change();
            return false;
        });
        $(document).on('click','.plusDaily',function () {
            var $input = $(this).parent().find('input');
            $input.val(parseInt($input.val()) + 1);
            $input.change();
            return false;
        });
    });
    $(document).on('submit','form#Form',function(e) {
        $('input').css('border','1px solid #3F0033')
        $('select').css('border','1px solid #3F0033')
        e.preventDefault();
        var formData = new FormData(this);
        var url = $(this).attr('action');
        $.ajax({
            url:url,
            type: 'POST',
            data: formData,
            beforeSend: function(){
                $('#createOrUpdateContent').append(loaderHtml)

                $('#mod-content-form').hide()

            },
            complete: function(){
                setTimeout(function () {
                    $('.lds-grid').hide()

                    $('#mod-content-form').show()

                },500)
            },
            success: function (data) {
                if (url == "{{route('available-times.store')}}"){
                    if (data.status == 200){
                        toastr.success(data.message);
                        $('#createOrUpdateModal').modal('hide')
                        changeMonth("{{$request->month}}")
                    }else {
                        toastr.error('Error !');
                    }
                }else{
                    if (data.status == 200){
                        toastr.success(data.message);
                        $('#createOrUpdateModal').modal('hide')
                    }else {
                        toastr.error('Error !');
                    }
                }
            },
            error: function (data) {
                if (data.status === 500) {
                    toastr.error('There is an error');
                }
                else if (data.status === 422) {
                    var errors = $.parseJSON(data.responseText);
                    $.each(errors, function (key, value) {
                        if ($.isPlainObject(value)) {
                            $.each(value, function (key, value) {
                                $('input[name='+key+']').css('border','1px solid red')
                                $('select[name='+key+']').css('border','1px solid red')
                                toastr.error(value,key);
                            });
                        }
                    });
                }else if(data.status === 423){
                    var errors = $.parseJSON(data.responseText);
                    $.each(errors, function (key, value) {
                        if ($.isPlainObject(value)) {
                            $.each(value, function (key, value) {
                                toastr.error(value,key);
                            });
                        }
                    });
                }
                else {
                    $('#addButton').html(`ADD`).attr('disabled', false);
                    toastr.error('there in an error');
                }
            },//end error method

            cache: false,
            contentType: false,
            processData: false
        });
    });
    function get_all_price(service_id,size_id,number){

        var url = '{{url('getPrice')}}';
        $.ajax({
            type: 'POST',
            url: url,
            data: {'service_id': service_id,'size_id': size_id},
            success: function (data) {
                if (data==1){
                toastr.warning('أنت اخترت خدمات و ماركات لم يتم تعريف سعرها بعد')
                }else {
                    // console.log(data.price+'السعر')
                    $('#total-value').val(data.price)
                    $('#price_total').val(parseFloat($('#total-value').val())*number);
                    //alert($('#total-value').val())
                    check_box()
                }
            }//end success
        });//end Ajax
    }
    function check_box() {
        $('#checkbox-value').val(0)
        $('#price_total').val(0)
        var number_of_cars=$('#number_of_cars').val();
        if (number_of_cars==null) {
            number_of_cars=1;
        }
        $('input.checked-inputs:checkbox:checked').each(function () {
            $('#checkbox-value').val(parseFloat($(this).attr('data-price'))+parseFloat($('#checkbox-value').val()));
        });

        $('#checkbox-value').val(number_of_cars*parseFloat($('#checkbox-value').val()))
        var all=parseFloat($('#total-value').val())*number_of_cars;
        $('#price_total').val(parseFloat($('#checkbox-value').val())+all);
    }

    function changeCount(){
        var number_of_cars=$('#number_of_cars').val();

        if (number_of_cars=='') {
            number_of_cars=1;
        }
        if (number_of_cars==null) {
            number_of_cars=1;
        }
        var service_id=$('#service_id option:selected').val();
        var size_id=$('#sub_type_id option:selected').attr('data-size');
        // console.log([service_id,size_id])
        if (size_id==null){
            toastr.error('اختر البيانات أولا قبل تحديد عدد السيارات ')
        }else{
            $('#price_total').val(0);
            get_all_price(service_id,size_id,number_of_cars);
        }
    }

    $(document).on('click','.informationData',function () {
        var url = $(this).data('url')
        $('#showContent').html(loaderHtml)
        $('#showModal').modal('show');

        $('#showContent').load(url);
    })


    $(document).on('click','.editOrder',function () {
        var id = $(this).data('id')
        $('#createOrUpdateContent').html(loaderHtml)
        $('#createOrUpdateModal').modal('show')

        var url = "{{route('available-times.edit',':id')}}"
        url = url.replace(':id',id)
        setTimeout(function () {
            $('#createOrUpdateContent').load(url)
        },500)
    })
    $(document).on('click','.deleteBtn',function () {
        var id = $(this).data('id')
        Swal.fire({
            title: 'هل أنت متأكد من الحذف؟',
            icon: 'question',
            iconHtml: '؟',
            confirmButtonText: 'نعم',
            cancelButtonText: 'لا',
            showCancelButton: true,
            showCloseButton: true
        }).then(function (result) {
            if (result.isConfirmed){
                var url = "{{route('available-times.destroy',':id')}}"
                url = url.replace(':id',id)
                $.ajax({
                    url: url,
                    method: 'delete',
                    beforeSend: function(){
                        $('.spinner').show()
                    },
                    success: function (data) {
                        if (data.status == true){
                            toastr.success(data.message)
                            setTimeout(function () {
                                changeMonth("{{$request->month}}")
                                loadDay(data.date)
                            },500)
                        }
                    }
                })
            }
        })
    })
    $(document).on('change keyup keydown','.filterByPlace',function(){
        var filter, table, tr, td, i, txtValue;
        filter = $(this).val().toUpperCase();
        console.log(filter)
        table = document.getElementById("available-times-table");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    });
</script>
