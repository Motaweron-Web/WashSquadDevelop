<!-- JAVASCRIPT -->
<script src="{{url('assets/admin')}}/libs/jquery/jquery.min.js"></script>
<script src="{{url('assets/admin')}}/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="{{url('assets/admin')}}/libs/metismenu/metisMenu.min.js"></script>
<script src="{{url('assets/admin')}}/libs/simplebar/simplebar.min.js"></script>
<script src="{{url('assets/admin')}}/libs/node-waves/waves.min.js"></script>

<script src="{{url('assets/admin')}}/js/app.js"></script>
<script src="{{asset('assets/admin/js/toastr.min.js')}}"></script>
<script src="{{asset('assets/admin/js/sweetalert2.js')}}"></script>
@toastr_render


<script>
    //for input number validation
    $(document).on('keyup','.numbersOnly',function () {
        this.value = this.value.replace(/[^0-9\.]/g,'');
    });
    $.ajaxSetup({
        headers:
            { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });
    $(document).ready(function (){
        $('.spinner').fadeOut(1000)
    })
</script>
@yield('js')

{{--<script src="{{url('assets/admin')}}/libs/jquery/jquery.min.js"></script>--}}
{{--<script src="{{url('assets/admin')}}/libs/bootstrap/js/bootstrap.bundle.min.js"></script>--}}
{{--<script src="{{url('assets/admin')}}/libs/metismenu/metisMenu.min.js"></script>--}}
{{--<script src="{{url('assets/admin')}}/libs/simplebar/simplebar.min.js"></script>--}}
{{--<script src="{{url('assets/admin')}}/libs/node-waves/waves.min.js"></script>--}}
{{--<!-- apexcharts js -->--}}
{{--<script src="{{url('assets/admin')}}/libs/apexcharts/apexcharts.min.js"></script>--}}
{{--<!-- jquery.vectormap map -->--}}
{{--<script src="{{url('assets/admin')}}/libs/jqvmap/jquery.vmap.min.js"></script>--}}
{{--<script src="{{url('assets/admin')}}/libs/jqvmap/maps/jquery.vmap.usa.js"></script>--}}
{{--<script src="{{url('assets/admin')}}/js/pages/dashboard.init.js"></script>--}}
{{--<script src="{{url('assets/admin')}}/js/app.js"></script>--}}
