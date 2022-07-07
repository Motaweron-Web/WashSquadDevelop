<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public  function getproducts()
    {
        if(!checkPermission(33))
            return view('admin.permission.index');
        $products=Product::get();
        $categories=Category::get();
        return view('admin.home.products.index',compact('products','categories'));

    }
    public function createproduct()
    {
        if(!checkPermission(33))
            return view('admin.permission.index');
      $categories=Category::get();
        return view('admin.home.products.create',compact('categories'));

    }
    public function addproduct(Request $request){

        if(!checkPermission(33))
            return view('admin.permission.index');

        $validator=\Validator::make($request->all(),
            [
                'title_ar'=>'required',
                'title_en'=>'required',
                'category_id'=>'required',
                'price'=>'required',
                'is_low_price'=>'required',
                'desc_ar'=>'required',
                'desc_en'=>'required',
                'link'=>'required',
                'image'=>'required',
                'low_price_value'=>'nullable',

            ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $data=[
            'title_ar'=>$request->title_ar,
            'title_en'=>$request->title_en,
            'category_id'=>$request->category_id,
            'price'=>$request->price,
            'is_low_price'=>$request->is_low_price,
            'desc_ar'=>$request->desc_ar,
            'desc_en'=>$request->desc_en,
            'link'=>$request->link,


        ];
        if($request->file('image'))
        {
            $image=$request->file('image');
            $imagename='assets/admin/images/products/'.time().$image->getclientOriginalName();
            $img=\Image::make($image->getRealPath());
            $img->resize(350,350);
            $img->save(public_path($imagename));

            $data['image']=$imagename;
        }
        if($request->low_price_value)
        {
            $data['low_price_value']=$request->low_price_value;
        }

        Product::create($data);
        return redirect()->route('getproducts');


    }


    public function deleteproduct(Request $request){

        $product=Product::find($request->id);
        if($product==null)
            return response()->json(['status' => false]);

        $product->delete();
        return response()->json(['status' => true]);

    }

    public function editproduct($id){
        if(!checkPermission(33))
            return view('admin.permission.index');
        $product=Product::find($id);
        $categories=Category::get();
        return view('admin.home.products.update',compact('categories','product'));

    }

public function updateproduct($id,Request $request){

    if(!checkPermission(33))
        return view('admin.permission.index');
    $validator=\Validator::make($request->all(),
        [
            'title_ar'=>'required',
            'title_en'=>'required',
            'category_id'=>'required',
            'price'=>'required',
            'is_low_price'=>'required',
            'desc_ar'=>'required',
            'desc_en'=>'required',
            'link'=>'required',
            'image'=>'nullable',
            'low_price_value'=>'nullable',

        ]);
    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
    }
    $data=[
        'title_ar'=>$request->title_ar,
        'title_en'=>$request->title_en,
        'category_id'=>$request->category_id,
        'price'=>$request->price,
        'is_low_price'=>$request->is_low_price,
        'desc_ar'=>$request->desc_ar,
        'desc_en'=>$request->desc_en,
        'link'=>$request->link,


    ];
    if($request->file('image'))
    {
        $image=$request->file('image');
        $imagename='assets/admin/images/products/'.time().$image->getclientOriginalName();
        $img=\Image::make($image->getRealPath());
        $img->resize(350,350);
        $img->save(public_path($imagename));

        $data['image']=$imagename;
    }
    if($request->low_price_value)
    {
        $data['low_price_value']=$request->low_price_value;
    }
    else
    {
        $data['low_price_value']=$request->low_price_value;

    }

    $product=Product::find($id);
    $product->update($data);
    return redirect()->route('getproducts');

}
public function productsearch(Request $request){
    if(!checkPermission(33))
        return view('admin.permission.index');
    $categories=Category::get();
    $searchkey=$request->product;
        if($request->category_id==0){
            $products=Product::where("title_ar","like","%$request->product%")->get();
            return view('admin.home.products.index',compact('products','categories','searchkey'));

        }

        $products=Product::where("title_ar","like","%$request->product%")->where('category_id',$request->category_id)->get();

    return view('admin.home.products.index',compact('products','categories','searchkey'));

}

}
