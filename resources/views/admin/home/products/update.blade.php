@extends('admin.layouts.inc.app')
@section('content')


    <!-- breadcrumb -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item"> <a href="online_store_products.html"> إضافة منتج
                </a> </li>
            <li class="breadcrumb-item active"> <a href="#!"> جديد </a> </li>
        </ol>
        <button class="btn btn-dark" onclick="history.back()"> عودة </button>
    </div>
    <!-- end breadcrumb -->
    <!-- edit Service -->
    <section class="editService">
        <form action="{{route('updateproduct',$product->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-12 p-2">
                    <label class="form-label"> الصورة   </label>

                    <div class="col-md-12 mb-3">
                        <div class="d-flex justify-content-center align-items-center">
                            <input type="file"  name="image" id="input-file-now-custom-1" class="dropify"
                                   data-default-file="{{asset(''.$product->image)}}" >
                        </div>
                    </div>
                </div>
                <div class="col-md-6 p-2">
                    <label class="form-label"> اسم المنتج باللغة العربية </label>
                    <input name="title_ar" value="{{$product->title_ar}}" class="form-control" type="text">
                </div>
                <div class="col-md-6 p-2">
                    <label class="form-label"> اسم المنتج باللغة الانجليزية </label>
                    <input name="title_en" value="{{$product->title_en}}" class="form-control" type="text">
                </div>
                <div class="col-md-6 p-2">
                    <label class="form-label"> التصنيف </label>
                    <select name="category_id" class="form-select">
                        @foreach($categories as $category)
                            <option @if($product->category_id==$category->id) selected @endif value="{{$category->id}}">  {{$category->title_ar}} </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 p-2">
                    <label class="form-label"> السعر </label>
                    <input name="price" value="{{$product->price}}" class="form-control" type="number">
                </div>
                <div class="col-md-6 p-2">
                    <label class="form-label"> سعر مخفض </label>
                    <div class="d-flex align-items-center">
                        <div class="form-check px-4">
                            <input @if($product->is_low_price=='yes') checked @endif  class="form-check-input lowervalue"  type="radio"  name="is_low_price" id="offer1"
                                   value="yes">
                            <label class="form-check-label" for="offer1">
                                نعم
                            </label>
                        </div>
                        <div class="form-check px-4 ">
                            <input @if($product->is_low_price=='no') checked @endif  class="form-check-input lowervalue" type="radio" name="is_low_price" id="offer2"
                                   value="no">
                            <label class="form-check-label" for="offer2">
                                لا
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 p-2" id="demo" @if(!$product->low_price_value) style="display: none" @endif>
                    <label class="form-label"> السعر المخفض </label>
                    <input id="emptyval"  value="{{$product->low_price_value}}" name="low_price_value" class="form-control" type="number">
                </div>
                <div class="col-md-6 p-2">
                    <label class="form-label"> الوصف باللغة العربية </label>
                    <textarea  name="desc_ar"  class="form-control" rows="8">{{$product->desc_ar}}</textarea>
                </div>
                <div class="col-md-6 p-2">
                    <label class="form-label"> الوصف باللغة الانجليزية </label>
                    <textarea name="desc_en" class="form-control" rows="8">{{$product->desc_en}}</textarea>
                </div>
                <div class="col-md-12 p-2">
                    <label class="form-label"> رابط المنتج</label>
                    <input name="link" value="{{$product->link}}" class="form-control" type="url">
                </div>
            </div>
            <div class="text-end py-2">
                <button type="submit" class="btn orangeBtn w-100"> اضافة </button>
            </div>
        </form>
    </section>










@endsection



@section('style')

    <!-- dropify -->
    <link rel="stylesheet" href="{{asset('assets/css/dropify.min.css')}}">
    <!-- img gallery -->
    <link rel="stylesheet" href="{{asset('assets/css/jquery.fancybox.min.css')}}">
    <!-- Custom style  -->
    <link rel="stylesheet" id="StyleLink" href="{{asset('assets/css/style.css')}}">
    <!-- responsive style  -->
    <link rel="stylesheet" href="{{asset('assets/css/responsive.css')}}">


    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">
    <!-- jvectormap -->
    <link href="{{asset('assets/libs/jqvmap/jqvmap.min.css')}}" rel="stylesheet" />
    <!-- Bootstrap Css -->
    <link href="{{asset('assets/css/bootstrap-rtl.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Plugins css -->
    <link href="{{asset('assets/libs/dropzone/min/dropzone.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{asset('assets/css/app-rtl.min.css')}}" rel="stylesheet" type="text/css" />

@endsection

@section('js')

    <!-- JAVASCRIPT -->
    <script src="{{asset('assets/libs/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/libs/metismenu/metisMenu.min.js')}}"></script>
    <script src="{{asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
    <script src="{{asset('assets/libs/node-waves/waves.min.js')}}"></script>
    <!-- dropzone js -->
    <script src="{{asset('assets/libs/dropzone/min/dropzone.min.js')}}"></script>
    <!-- apexcharts js -->
    <script src="{{asset('assets/libs/apexcharts/apexcharts.min.js')}}"></script>
    <!-- jquery.vectormap map -->
    <script src="{{asset('assets/libs/jqvmap/jquery.vmap.min.js')}}"></script>
    <script src="{{asset('assets/libs/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
    <script src="{{asset('assets/js/pages/dashboard.init.js')}}"></script>
    <script src="{{asset('assets/js/app.js')}}"></script>
    <script src="{{asset('assets/js/jquery-3.5.1.min.js')}}"></script>
    <script src="{{asset('assets/js/popper.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.appear.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/mdb.min.js')}}"></script>
    <script src="{{asset('assets/js/swiper.js')}}"></script>
    <script src="{{asset('assets/js/wow.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.fancybox.min.js')}}"></script>
    <script src="{{asset('assets/js/fontawesome-pro.js')}}"></script>
    <script src="{{asset('assets/js/odometer.min.js')}}"></script>
    <script src="{{asset('assets/js/select2.js')}}"></script>
    <script src="{{asset('assets/js/ma5-menu.min.js')}}"></script>
    <script src="{{asset('assets/js/dropify.min.js')}}"></script>
    <script src="{{asset('assets/js/Custom.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ajaxy/1.6.1/scripts/jquery.ajaxy.min.js"></script>

    <script>
        if($('#emptyval').val()=='no')
        {
            $('#emptyval').val('');
            $('#demo').hide();
        }
        $(document).on("click",".lowervalue", function (e) {
            var type= $(this).val();

            if(type=='no')
            {
                $('#emptyval').val('');
                $('#demo').hide();
            }
            else{
                $('#emptyval').val({{$product->low_price_value}});
                $('#demo').show();

            }
        });
    </script>









@endsection

