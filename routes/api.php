<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('apyStatus',function (Request $request){
    return response($request->status);
});


Route::get('backFromPay','Client\ClientOrderController@backFromPay');



/* ================Visits System===================*/


Route::post('visit', 'VisitsController@store');
Route::get('testSMS', 'Client\ClientAuthController@sendSMS');


/* ================Visits System===================*/

/* ================Tokens System===================*/


Route::post('phone-tokens', 'TokenController@token_update');
Route::post('phone/token/delete', 'TokenController@token_delete');



/* ================Tokens System===================*/


/* ================Setting System===================*/
Route::post('contact-us', 'ContactController@contact_us');
Route::get('all-social', 'SettingController@all_social');
Route::get('about-us', 'SettingController@about_us');
Route::get('slider', 'SettingController@slider');
Route::get('setting', 'SettingController@setting');
Route::get('all-coupons', 'HelperController@all_coupons');

/* ================Setting System===================*/



/* ================Helper Links===================*/

Route::get('places', 'HelperController@places');//all places
Route::get('dayByPlacesAndServices', 'HelperController@dayByPlacesAndServices');//all places



Route::get('services', 'HelperController@services');//all Services
Route::post('single/service', 'HelperController@single_service');//single services


Route::get('carSizes', 'HelperController@carSizes');//all Car Sizes
Route::get('carTypes', 'HelperController@carTypes');//all Car Types
Route::post('single-carType', 'HelperController@single_car_type');//all Car Types

Route::get('cancelReasons', 'HelperController@cancelReasons');//all cancel Reasons

Route::get('offers', 'HelperController@offers');//all offers
Route::get('questions', 'HelperController@questions');//all questions
Route::get('workTimes', 'HelperController@workTimes');//all workTimes
Route::post('user', 'HelperController@get_client_or_driver_user');//users
Route::post('date/get/times', 'HelperController@get_date_times');//

Route::get('coupons', 'HelperController@coupons');//all coupons
Route::post('coupon/check', 'HelperController@check_coupon');//coupons

Route::post('order/images/get', 'HelperController@get_images_by_status');//get_images_by_status
Route::post('getPrice','HelperController@getPrice');


//my notification
Route::post('my-notifications','ApiNotificationController@my_notifications'); //
Route::post('orders','ApiOrderController@all_orders'); //
Route::post('single-order','ApiOrderController@single_order'); //
Route::post('current-orders','ApiOrderController@all_current_orders'); //


/* ================Helper Links===================*/


/* ================ Client System===================*/


//auth

Route::post('client/register','Client\ClientAuthController@register'); // Register
Route::post('client/login','Client\ClientAuthController@login'); // login
Route::post('client/logout','Client\ClientAuthController@logout'); // logout
Route::post('client/cofirm-code','Client\ClientAuthController@confirm_code'); // confirm Code
Route::post('client/code/send','Client\ClientAuthController@resend'); // confirm Code
Route::post('client/password/forget','Client\ClientAuthController@forget_pass');//forget
Route::post('client/passwordCode/confirm','Client\ClientAuthController@confirm_passwordCode');//confirm_passwordCode
Route::post('client/password/reset','Client\ClientAuthController@reset_pass');//reset pass
Route::post('client/password/change','Client\ClientAuthController@change_pass');//change pass




//actions
Route::post('order/add','Client\ClientOrderController@add_order'); // client_rate_order
Route::post('order/rate','Client\ClientActionController@client_rate_order'); // client_rate_order
Route::post('order/send-gift','Client\ClientOrderController@send_gift');
Route::post('order/update-subscription','Client\ClientOrderController@update_subscription');

//profile

Route::post('profile/edit','Client\ClientProfileController@user_profile_edit');

/*;

Route::post('user','ProfileController@get_user');
Route::post('market/profile','ProfileController@show_profile');

Route::post('my-notification','NotificationController@my_notifications');*/


/* ================Auth Client System===================*/


/* ================Start Auth driver System===================*/
Route::post('driver/login','Driver\DriverAuthController@login'); // login
Route::post('driver/logout','Driver\DriverAuthController@logout'); // logout

//actions

Route::post('driver/order/start','Driver\DriverActionController@driver_start_order'); // start order
Route::post('driver/upload/images','Driver\DriverActionController@driver_upload_images'); // Driver Upload Images

Route::post('driver/order/reject','Driver\DriverActionController@driver_reject_order'); // cancel order
Route::post('driver/order/cancel','Driver\DriverActionController@driver_cancel_order'); // cancel order
Route::post('driver/order/end','Driver\DriverActionController@driver_end_order'); // end order





Route::post('user-current-orders','ApiOrderController@user_current_orders'); // end order
Route::post('user-previous-orders','ApiOrderController@user_per_orders'); // end order



/* ================End Auth driver System===================*/


////////////////// mohamed gamal /////////////////////////
################## driver //////////////
Route::post('driver/order/amount','Driver\DriverActionController@order_amount'); // order amount
Route::post('driver/order/review','Driver\DriverActionController@order_review'); // end review

################## client //////////////
Route::get('order/getSubscription','Client\ClientOrderController@getSubscription');
Route::POST('order/edit','Client\ClientOrderController@edit_order');



/////////////////// order
Route::post('order/updateOrderStatus','ApiOrderController@updateOrderStatus'); // cancel order
Route::get('order/print/{id}','ApiOrderController@print'); // cancel order
Route::POST('storeImage','ApiOrderController@storeImage'); // cancel order

////////////////////// end mohamed gamal ////////////////////

