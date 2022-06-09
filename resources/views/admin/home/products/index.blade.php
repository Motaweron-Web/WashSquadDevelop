@extends('admin.layouts.inc.app')
@section('content')







    <!-- date -->
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
        <div class="p-2">
            <a href="{{route('createproduct')}}" class="stoped">
                <i class="fas fa-plus me-2"></i>
                منتج جديد
            </a>
        </div>
        <form method="post" action="{{route('productsearch')}}">
            @csrf
        <div class="d-flex flex-wrap justify-content-end align-items-center mb-3">
            <div class="p-2">
                <div class="input-group">
                    <input type="search" @isset($searchkey) value="{{$searchkey}}" @endisset name="product" class="form-control searchInput" aria-describedby="searchLabel">
                    <button type="submit" class="input-group-text searchLabel" id="searchLabel"><i
                            class="fas fa-search"></i></button>

                </div>

            </div>
            <div class="p-2">
                <select onchange="this.form.submit()"  name="category_id" class="form-select shadow-lg">
                    <option value="0" selected > كل الاقسام </option>
                    @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->title_ar}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        </form>
    </div>
    <!-- end date -->
    <!-- products -->
    <section class="products">
        <div class="row">
            <!-- product -->
            @foreach($products as $product)
            <div class="col-md-3 p-3" id="{{$product->id}}">
                <div class="product">
                    <img src="{{asset(''.$product->image)}}" alt="">
                    <h5>{{$product->title_ar}} </h5>
                    <div class="price">
                     @if($product->is_low_price=='yes')   <p class="old"> {{$product->price}} <span> ر.س </span> </p> @endif
                        <p class="new">@if($product->is_low_price=='yes') {{$product->low_price_value}} @else {{$product->price}} @endif <span> ر.س </span> </p>
                    </div>
                    <div class="productButtons">
                        <a href="{{route('editproduct',$product->id)}}" class="btn edit">
                            تعديل
                        </a>
                        <button productid="{{$product->id}}"  class="btn trash deleteproduct">
                            حذف
                        </button>
                    </div>
                </div>
            </div>
            <!-- end product -->
            <!-- product -->
            @endforeach

        </div>
    </section>


@endsection



@section('style')
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">
    <link href="{{asset('assets/libs/jqvmap/jqvmap.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet"
          type="text/css" />
    <link href="{{asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" rel="stylesheet"
          type="text/css" />
    <link href="{{asset('assets/libs/dropzone/min/dropzone.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/bootstrap-rtl.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/app-rtl.min.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('js')
    <!-- JAVASCRIPT -->
    <!-- JAVASCRIPT -->
    <script src="{{asset('assets/libs/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/libs/metismenu/metisMenu.min.js')}}"></script>
    <script src="{{asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
    <script src="{{asset('assets/libs/node-waves/waves.min.js')}}"></script>
    <script src="{{asset('assets/libs/apexcharts/apexcharts.min.js')}}"></script>
    <script src="{{asset('assets/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/libs/jszip/jszip.min.js')}}"></script>
    <script src="{{asset('assets/libs/pdfmake/build/pdfmake.min.js')}}"></script>
    <script src="{{asset('assets/libs/pdfmake/build/vfs_fonts.js')}}"></script>
    <script src="{{asset('assets/libs/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('assets/libs/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('assets/libs/datatables.net-buttons/js/buttons.colVis.min.js')}}"></script>
    <script src="{{asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/libs/dropzone/min/dropzone.min.js')}}"></script>
    <script src="{{asset('assets/js/pages/datatables.init.js')}}"></script>
    <script src="{{asset('assets/libs/jqvmap/jquery.vmap.min.js')}}"></script>
    <script src="{{asset('assets/libs/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
    <script src="{{asset('assets/js/pages/dashboard.init.js')}}"></script>
    <script src="{{asset('assets/js/app.js')}}"></script>

    <script>
        $(document).on("click",".deleteproduct", function (e) {
            e.preventDefault();
            var id= $(this).attr('productid');

            $.ajax({
                type:'GET',
                url:"{{route('deleteproduct')}}",
                data:{
                    id:id,
                },

                success:function(res){
                    if(res['status']==true)
                    {

                        $(`#${id}`).remove();

                    }
                    else if(res['status']==false)
                        location.reload();


                },
                error: function(data){
                    alert('error');
                }
            });

        });
    </script>




@endsection
