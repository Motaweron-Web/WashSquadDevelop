<?php
use Spatie\Browsershot\Browsershot;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('firebase', function () {
    return view('firebase');
});

Route::get('/clear-config', function () {
    return "optimize clear";
});

Route::get('/lang/{lang}', function ($lang) {


    if (in_array($lang, ['ar', 'en', 'es'])) {


        if (session()->has('lang')) {

            session()->forget('lang');
        }
        session()->put('lang', $lang);


    } else { // end of array

        if (session()->has('lang')) {

            session()->forget('lang');
        }
        session()->put('lang', 'ar');

    }


    return back();
});


Route::middleware(['Lang'])->group(function () {

    Route::get('order/images/view/{id}', 'PublicFunController@view_images');

    Route::get('link/sms/order/{id}', 'CheckPlaceController@index');//link
    Route::post('link/activate', 'CheckPlaceController@link_activate');
    Route::post('add/place', 'CheckPlaceController@add_place');
    Route::get('/', function () {
        return view('index');
    });

    Route::get('/login', 'WebAuthController@login_view')->name('login');//login view
    Route::post('login', 'WebAuthController@login');//login action
    Route::get('custom-logout', 'WebAuthController@logout');//logout


    /*==========================Employee=======================*/
    Route::middleware(['Employee'])->group(function () {

        Route::get('employee/home', 'Employee\EmployeeController@index')->name('employee.home');

        Route::get('employee/services', 'Employee\EmployeeController@services')->name('employee.services');
        Route::get('employee/sub/services', 'Employee\EmployeeController@sub_services')->name('employee.sub_services');

        Route::get('employee/orders', 'Employee\EmployeeController@orders')->name('employee.orders');
        Route::get('employee/ordersFromWeb', 'Employee\EmployeeController@ordersFromWeb')->name('employee.ordersFromWeb');
        Route::get('order/create/page', 'Employee\EmployeeController@create_order_view')->name('employee.order.create');
        Route::post('order/create/action', 'Employee\EmployeeController@create_order_action');
        //order edit
        Route::get('order/edit/{id}/page', 'Employee\EmployeeController@order_edit')->name('orderEdit');
        Route::post('order/edit/action/{id}', 'Employee\EmployeeController@order_update')->name('orderEditAction');


        //Orders
        Route::post('orders/date/get', 'Employee\EmployeeController@get_orders');

        Route::post('View/images', 'Employee\EmployeeController@View_images');
        Route::get('orders/count', 'Employee\EmployeeController@display_order_number');
        //get all booking number
        Route::post('driver/insert', 'Employee\EmployeeController@driver_insert');
        //more_details
        Route::post('more_details', 'Employee\EmployeeController@more_details');
        //
        Route::get('order_counts', 'Employee\order_countController@index')->name('order_counts.index');
        Route::get('order_counts/create', 'Employee\order_countController@create')->name('order_counts.create');
        Route::get('order_counts/{id}/edit', 'Employee\order_countController@edit')->name('order_counts.edit');
        Route::post('order_counts/store', 'Employee\order_countController@store')->name('order_counts.store');
        Route::put('order_counts/update/{id}', 'Employee\order_countController@update')->name('order_counts.update');

        /**
         *
         * 10 - 8 - 2020
         *
         * Edits
         *
         *
         */

        Route::get('marketerOrdersView/{id}',
            'Employee\EmployeeController@getMarketerOrdersView')
            ->name('getMarketerOrdersView');


        Route::post('getMarketerOrders',
            'Employee\EmployeeController@getMarketerOrders')
            ->name('getMarketerOrders');


        Route::get('driverStatus',
            'Employee\EmployeeController@driverStatus')
            ->name('driverStatus');

        Route::get('ordersScreen',
            'Employee\EmployeeController@orders_screen')
            ->name('ordersScreen');


        Route::get('driverOrders',
            'Employee\EmployeeController@drivers_order_screen')
            ->name('driverOrders');

        Route::get('marketerOrders',
            'Employee\EmployeeController@marketerOrders')
            ->name('marketerOrders');

        Route::get('ratingOrders',
            'Employee\EmployeeController@ratingOrders')
            ->name('ratingOrders');

        Route::get('changeRatingOrders',
            'Employee\EmployeeController@changeRatingOrders')
            ->name('changeRatingOrders');



    });//employee

    /*=========================Marketer========================*/
    Route::middleware(['Marketer'])->group(function () {

        Route::get('marketer/home', 'Marketer\MarketerController@index')->name('marketer.home');

        Route::get('marketer/services', 'Marketer\MarketerController@services')->name('marketer.services');
        Route::get('marketer/sub/services', 'Marketer\MarketerController@sub_services')->name('marketer.sub_services');

        Route::get('marketer/orders', 'Marketer\MarketerController@orders')->name('marketer.orders');
        Route::get('marketer/order/create/page', 'Marketer\MarketerController@create_order_view')->name('marketer.order.create');
        Route::post('marketer/order/create/action', 'Marketer\MarketerController@create_order_action');
        Route::post('marketer/edit/profile', 'Marketer\MarketerController@edit_profile');

        //all orders
        Route::get('marketer/all-orders', 'Marketer\MarketerController@all_orders')->name('marketer.all-orders');
        Route::get('marketer/order/delete/{id}', 'Marketer\MarketerController@delete_order')->name('marketer.order.delete');


        Route::post('marketer/orders/date/get', 'Marketer\MarketerController@get_orders');
        Route::post('marketer/View/images', 'Marketer\MarketerController@View_images');
        Route::get('marketer/orders/count', 'Marketer\MarketerController@display_order_number');
    });//marketer


    Route::post('get/map', 'Marketer\MarketerController@createMap');
});//End lang middleware

Route::post('cancel/order', 'Employee\EmployeeController@cancel_order');

Route::get('send_map_again/{id}', 'Employee\EmployeeController@send_map_again')->name('send_map_again');


Route::post('get/sub/services', 'PublicFunController@get_sub_services');
Route::post('get/sub/sub/services', 'PublicFunController@get_sub_sub_services');
Route::post('get_sub_types', 'PublicFunController@get_sub_types');

Route::get('test', 'Employee\EmployeeController@display_order_number');//test link
Route::post('contact-us', 'PublicFunController@contact_us');
Route::get('show-map/{id}', 'PublicFunController@show_map');
Route::post('edit/ordersCount', 'Employee\EmployeeController@edit_order_number')->name('edit/ordersCount');

Route::get('tester', 'Marketer\MarketerController@display_order_number');
Route::post('getPrice', 'PublicFunController@getPrice');


//======================================================================
/*Route::get('time',function (){
      $local = strtotime(date("H:i",time()));

    date_default_timezone_set("Asia/Riyadh");
    $sad =strtotime( date("H:i",time()) );
    return ["local"=>$local ,"sad"=>$sad];
});*/
Route::get('time', 'Employee\EmployeeController@tester');
//======================================================================
