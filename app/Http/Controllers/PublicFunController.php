<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Service;
use App\Models\OrderImage;
use Illuminate\Http\Request;
use App\Models\CarType;
use App\Models\Contact;
use App\Helper\GoogleMaps;
use App\Models\Price;
use App\Models\SubServiceOrder;
use DB;
class PublicFunController extends Controller
{

    /*=====================All Order Images============================*/
    public function view_images($id){

        $order=Order::find($id);

        if (!$order){

            return 'this order not exist';
        }

        $images='';
        $order=Order::find($id);

        $check=0;
        $order_images=OrderImage::where('order_id',$order->id)->get();
        $order_images_array=array();
        if ($order_images->count()!=0){

            $i=0;
            $order_images_array=array();
            $order_Images=$order_images->toArray();
            //  dd($order_Sub_services);111111111
            $images='<div class="row">';
            foreach ($order_Images as $order_Image){


                $order_Image['order_image_type']=$order_Image['type'];
                $order_Image['order_status']=$order_Image['status'];
                $order_Image['order_image']=$order_Image['image'];


                $order_images_array[$i]=$order_Image;
                /* $images.='<div class="popup-modal col"> <a class="image-popup-fit-width" href="'.asset('upload').'/'.$order_Image['image'].'" title="'.trans('main.OrderImages').'">
                  <img  width="300" height="300" src="'.asset('upload').'/'.$order_Image['image'].'" ></a></div>';*/

                $images.='<div class="popup-modal col"><img  width="300" height="300" src="'.asset('upload').'/'.$order_Image['image'].'" ></div>';

                $i++;

            }
            $images.='</div>';


        }
        else{

            $check=1;

        }

        if ($check==1){
            toastr()->error(trans('webLang.NoImage'));

            return redirect()->back();
        }



        return view('show-order-images')->with(['images'=>$images,'check'=>$check,'order'=>$order,'order_images'=>$order_images_array]);
    }//end


    /*========================get sub services==========================*/

    public function get_sub_services(Request $request){

        $check=0;
        $subs=Service::where('level',2)->where('parent_id',$request->id)->get();

        $sub_title='اختر الباقة';

          $sub_service_id = isset($_GET['sub_service_id'])?$_GET['sub_service_id']!=null?$_GET['sub_service_id']:0:0;
          if ($sub_service_id != null){
              $options='';
          }else{
              $options='<option value="" selected disabled>'.$sub_title.'</option>';

          }

        if ($subs->count()!=0){

            foreach ($subs as $sub){
                $selected=$sub_service_id==$sub->id?"selected":"";
                $options.='<option '.$selected.' value="'.$sub->id.'">'.$sub->ar_title.'</option>';
            }
            $check=1;
        }


        return response(['options'=>$options,'check'=>$check],200);


    }//end

    /*========================get sub sub services==========================*/

    public function get_sub_sub_services(Request $request){

        $check=0;
        $subs=Service::where('level',3)->where('parent_id',$request->id)->OrderBy('created_at','desc')->get();
        $order_id=isset($_GET['order_id'])?$_GET['order_id']!=null?$_GET['order_id']:0:0;
        $old_sub_service=[];
        if ($order_id != null){
            $old_sub_service = SubServiceOrder::where('order_id',$order_id)->pluck('sub_service_id')->toArray();
        }
        $options='';

        if ($subs->count()!=0){

            foreach ($subs as $sub){
                $price=Price::where('size_id',$request->size_id)->where('service_id',$sub->id)->first();
                $selected=is_array($old_sub_service)?in_array($sub->id,$old_sub_service)?'checked':'':'';
                if ($price){
                    $options.='<input '.$selected.' data-price="'.$price->price.'" type="checkbox" name="sub_sun_services[]" class="checked-inputs"  value="'.$sub->id.'"> 	&nbsp;  <span style="font-weight: bold">'.$sub->ar_title.'</span> 	&nbsp;	&nbsp;<br>';

                }else{
                    $options.='<input '.$selected.' data-price="0" type="checkbox" name="sub_sun_services[]" class="checked-inputs"  value="'.$sub->id.'"> 	&nbsp;  <span style="font-weight: bold">'.$sub->ar_title.'</span> 	&nbsp;	&nbsp;<br>';

                }

            }
            $check=1;
        }


        return response(['options'=>$options,'check'=>$check],200);


    }//end

    /*========================  get sub types===================================*/
    public function get_sub_types(Request $request){
        $check=0;
        $price=0;
        $brand_id = isset($_GET['sub_type_id'])?$_GET['sub_type_id']!=null?$_GET['sub_type_id']:0:0;
        $subs=CarType::where('level',2)->where('parent_id',$request->id)->get();

        $sub_title='اختر الفئة';
        if ($brand_id == 0){
            $options='<option value="" selected disabled>'.$sub_title.'</option>';
        }else{
            $options='';
        }

        if ($subs->count()!=0){

            foreach ($subs as $sub){


                if ($sub->size!=0){
                    $price=\App\CarSize::where('id',$sub->size)->first()->price;
                }
                $selected=$brand_id==$sub->id?"selected":"";
                $options.='<option '.$selected.' data-size="'.$sub->size.'"  value="'.$sub->id.'">'.$sub->ar_title.'</option>';

            }
            $check=1;
        }


        return response(['options'=>$options,'check'=>$check],200);

    }
    /*============================Price =====================================*/
    public function getPrice(Request $request){
        $price=Price::where('service_id',$request->service_id)
            ->where('size_id',$request->size_id)
            ->first();
        if ($price){
            return response($price);
        }else
        {
            return response(1);
        }
    }//end

    /*============================contact_us=====================================*/
    public function contact_us(Request $request){

        $contact=new Contact();
        $contact->name=$request->name;
        $contact->email=$request->email;
        $contact->message=$request->message;
        $contact->save();
        toastr()->success('شكرا لتواصلك معنا');
        return redirect()->back();

    }

    /*============================Show Map =====================================*/
    public function show_map(Request $request,$id){

        $order=Order::find($id);
      //  dd($order);
        if (!$order){
            return redirect('/');
        }

        $data = $this->createMap($zoom = 6, $lat =$order->latitude , $long = $order->longitude, $draggable = true);
        return view('map-show')->with(['maps' => $data['maps']]);


    }


    public function createMap($zoom = 6, $lat = 27.511411, $long = 41.720825, $draggable = true)
    {
        //Prepare the Map for the view
        $theMap = new GoogleMaps();
        $config = array();
        $config['zoom'] = $zoom;
        $config['center'] = "{$lat}, {$long}";//'auto';
        $config['onboundschanged'] = '  if (!centreGot) {
                                            var mapCentre = map.getCenter();
                                            marker_0.setOptions({
                                                position: new google.maps.LatLng(mapCentre.lat(), mapCentre.lng())
                                            });
                                            $("#latitude").val(mapCentre.lat());
                                            $("#longitude").val(mapCentre.lng());
                                        }
                                        centreGot = true;';
        $config['geocodeCaching'] = TRUE;
        $marker = array();
        $marker['draggable'] = $draggable;
        $marker['ondragend'] = '$("#latitude").val(event.latLng.lat());$("#longitude").val(event.latLng.lng());';
        $marker['title'] = 'أنت هنا .. من فضلك قم بسحب العلامة ووضعها على المكان الصحيح';
        $theMap->initialize($config);
        $theMap->add_marker($marker);
        $data['maps'] = $theMap->create_map();
        return $data;
    }


}//end class
