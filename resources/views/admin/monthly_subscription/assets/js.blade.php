<!-- apexcharts js -->
<script src="{{url('assets/admin')}}/libs/apexcharts/apexcharts.min.js"></script>
<!-- jquery.vectormap map -->
<script src="{{url('assets/admin')}}/libs/jqvmap/jquery.vmap.min.js"></script>
<script src="{{url('assets/admin')}}/libs/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- dropzone js -->
<script src="{{url('assets/admin')}}/libs/dropzone/min/dropzone.min.js"></script>
<!-- Required datatable js -->
<script src="{{url('assets/admin')}}/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{url('assets/admin')}}/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>

<!-- Responsive examples -->
<script src="{{url('assets/admin')}}/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{url('assets/admin')}}/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
<!-- Datatable init js -->
{{--    <script src="{{url('assets/admin')}}/js/pages/datatables.init.js"></script>--}}
<script>
    var loaderHtml = '<div style="text-align: center;"><div class="lds-grid"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></div>';

    loadDay("{{date('Y-m-d')}}",false)

    $(document).on('click','.getData',function (e) {
        e.preventDefault();
        var date = $(this).data('date');
        console.log(date);
        loadDay(date,true)
    });

    function loadDay(date) {
        var url = "{{route('monthly-subscription.show',':id')}}";
        url = url.replace(':id',date)
        $('.spinner').show()
        $('#datatable-buttons').DataTable().destroy();
        $('#bodyToLoad').html('')

        $.get(url,function (data) {
            $('#bodyToLoad').html(data.html)
            var a = $("#datatable-buttons").DataTable({
                // lengthChange: !1,
                "order": [[ 5, "Asc" ]],

                language: {
                    "sProcessing":   "تحميل",
                    "sLengthMenu":   "اظهار _MENU_ سجل",
                    "sZeroRecords":  "لا يوجد نتائج للبحث",
                    "sInfo":         "اظهار _START_ الى  _END_ من _TOTAL_ سجل",
                    "sInfoEmpty":    "معلومات خالية",
                    "sInfoFiltered": "معلومات منتقاه",
                    "sInfoPostFix":  "",
                    "sSearch":       "بحث:",
                    "sUrl":          "",
                    "oPaginate": {
                        "sFirst":    "الاول",
                        "sPrevious": "السابق",
                        "sNext":     "التالى",
                        "sLast":     "الاخير"
                    },
                    paginate: {
                        previous: "<i class='mdi mdi-chevron-right'>",
                        next: "<i class='mdi mdi-chevron-left'>"
                    }
                },
                drawCallback: function (){
                    $(".dataTables_paginate > .pagination").addClass("pagination-rounded")
                },
                buttons: [ "excel",  ]
                // "pdf"
            });
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
        var newUrl = "{{route('monthly-subscription.index')}}?month="+val;
        $.ajax({
            url:"{{route('monthly-subscription.anotherMonth.index')}}?month="+val,
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
                    console.log(data.html)
                    $('.calender').html(data.html)
                    window.history.pushState({path:newUrl},'',newUrl);
                    location.reload();
                }else {
                    window.location = "{{route('monthly-subscription.index')}}?month={{date('Y-m')}}"
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
    $(document).on('click','.sub-details',function () {
        var url = $(this).data('url')
        $('#subscriptionContent').html(loaderHtml)
        $('#subscriptionModal').modal('show');
        $('#subscriptionContent').load(url);
    })

</script>
