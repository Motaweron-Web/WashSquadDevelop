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

@endsection

@section('js')


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
