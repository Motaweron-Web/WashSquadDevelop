<!doctype html>
<html lang="ar" style="direction: rtl;">

<head>
    {{-- incloude css --}}
    @include('admin.layouts.assets.css')
    @include('admin.layouts.loaders.assets.mainLoaderCss')
    @yield('style')
</head>

<body data-sidebar="dark">
@include('admin.layouts.loaders.inc.mainLoaderHtml')

<!-- Begin page -->
<div id="layout-wrapper">
    <!-- ==========  Header  ========== -->
        {{-- incloude header --}}
        @include('admin.layouts.inc.header')
    <!-- ==========  Sidebar  ========== -->
        {{-- incloude sidebar --}}
        @include('admin.layouts.inc.sidebar')
    <!-- ============================================================== -->
    <!-- Start right Content here -->

    <!-- ============================================================== -->
{{--    @yield()--}}
    @yield('cont')
    <div class="main-content">
        <div class="page-content @yield('class')">
            <div class="container-fluid">
                @yield('content')
            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
    </div>
    <!-- end main content-->
</div>
<!-- END layout-wrapper -->
<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>
<!-- JAVASCRIPT -->
{{-- incloude css --}}
@include('admin.layouts.assets.js')

<!-- orders-chart -->
<script>
    var options = {
            series: [{
                name: 'Orders',
                data: [440, 150, 270, 560, 610, 480, 630, 310, 180, 630, 60, 0]
            }],
            chart: {
                type: 'bar',
                height: 200
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '18%',
                    endingShape: 'rounded'
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            },

            fill: {
                opacity: 1
            },

        },

        chart = new ApexCharts(document.querySelector("#orders-chart"), options);

    chart.render();
</script>
<!-- gender-chart -->

<!-- top-orders-chart -->


</body>

</html>
