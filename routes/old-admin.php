<?php
use Illuminate\Support\Facades\Route;

Route::get('admin/lang/{lang}', function ($lang) {
    if (in_array($lang, ['ar', 'en', 'es'])) {
        if (session()->has('lang')) {
            session()->forget('lang');
        }
        session()->put('lang', $lang);
    } else { // end of array
        if (session()->has('lang')) {
            session()->forget('lang');
        }
        session()->put('lang', 'en');
    }
    return back();
});
Route::middleware(['Lang'])->group(function () {
    Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
        Config::set('auth.defines', 'admin');
        /*====================Start Admin Auth System==================*/
        Route::get('login', 'AdminLoginController@showLoginForm')->name('admin.login');
        Route::post('login', 'AdminLoginController@login')->name('admin.login.submit');
        /*====================End Admin Auth System==================*/
        /*====================Admin Panel==================*/
        Route::group(['middleware' => 'admin:admin'], function () {
            /*================LogOut===========*/
            Route::post('logout/', 'AdminLoginController@logout')->name('admin.logout');
            /*================Admin Home =========================*/
            Route::get('/home', 'AdminController@index')->name('admin.dashboard');
            Route::get('/sales-and-operation', 'AdminController@sales_and_operation')->name('admin.sales_and_operation');
            Route::post('update-target-setting', 'AdminController@update_target_setting')->name('admin.update_target_setting');
            /*================Admin Home =========================*/
            /*================Admin Setting control =========================*/
            Route::resource('setting', 'AdminSettingController');//setting
            //site texts
            Route::resource('siteTexts', 'AdminTextController');
            Route::post('siteTexts/delete', 'AdminTextController@delete')->name('siteTexts.delete');
            //Social
            Route::resource('socials', 'AdminSocialController');
            Route::post('socials/delete', 'AdminSocialController@delete')->name('socials.delete');
            //Slider
            Route::resource('sliders', 'AdminSliderController');
            Route::post('sliders/delete', 'AdminSliderController@delete')->name('sliders.delete');
            //Contacts
            Route::resource('contacts', 'AdminContactController');
            Route::post('contacts/delete', 'AdminContactController@delete')->name('contacts.delete');
            Route::get('contacts/email/{id}', 'AdminContactController@email_view')->name('contacts.email');
            Route::post('contacts/email', 'AdminContactController@send_Email')->name('contacts.send');
            //firbase Notification
            Route::resource('FirebaseNotification', 'AdminFirebaseNotificationController');
            //snd email to enyone
            Route::resource('adminEmails', 'SendEmailController');
            Route::post('adminEmails/email', 'SendEmailController@send_Email')->name('adminEmails.send');
            /*================Admin Setting control =========================*/
            /*================Admin Profile control =========================*/
            Route::resource('profile', 'AdminProfileController');
            Route::get('profile/password/{id}', 'AdminProfileController@update_pass_view')->name('profile.change.pass.view');
            Route::post('profile/password/change', 'AdminProfileController@update_pass')->name('profile.change.pass');
            /*================Admin Admin control =========================*/
            Route::resource('admins', 'AdminAdminController');
            Route::post('admins/delete', 'AdminAdminController@delete')->name('admins.delete');
            /*================Admin Users control =========================*/
            Route::resource('users', 'AdminUserController');
            Route::post('users/delete', 'AdminUserController@delete')->name('users.delete');
            Route::get('users/active/{id}', 'AdminUserController@is_active')->name('users.active');
            /*================Admin Drivers control =========================*/
            Route::resource('drivers', 'AdminDriverController');
            Route::post('drivers/delete', 'AdminDriverController@delete')->name('drivers.delete');
            Route::get('drivers/active/{id}', 'AdminDriverController@is_active')->name('drivers.active');
            /*================Admin Emplyee control =========================*/
            Route::resource('employees', 'AdminEmployeeController');
            Route::post('employees/delete', 'AdminEmployeeController@delete')->name('employees.delete');
            Route::get('employees/active/{id}', 'AdminEmployeeController@is_active')->name('employees.active');
            /*================Admin Marketer control =========================*/
            Route::resource('marketers', 'AdminMarketerController');
            Route::post('marketers/delete', 'AdminMarketerController@delete')->name('marketers.delete');
            Route::get('marketers/active/{id}', 'AdminMarketerController@is_active')->name('marketers.active');
            /*================Admin Packages control =========================*/
            Route::resource('packages', 'AdminPackageController');
            Route::post('packages/delete', 'AdminPackageController@delete')->name('packages.delete');
            /*================Admin carSizes control =========================*/
            Route::resource('carSizes', 'AdminCarSizeController');
            Route::post('carSizes/delete', 'AdminCarSizeController@delete')->name('carSizes.delete');
            /*================Admin carTypes control =========================*/
            Route::resource('subCarTypes', 'AdminSubTypesController');
            Route::post('subCarTypes/delete', 'AdminSubTypesController@delete')->name('subCarTypes.delete');
            /*================Admin sub carTypes control =========================*/
            Route::resource('carTypes', 'AdminCarTypeController');
            Route::post('carTypes/delete', 'AdminCarTypeController@delete')->name('carTypes.delete');
            /*================Admin cancel Reasons control =========================*/
            Route::resource('cancels', 'AdminCancelReasonController');
            Route::post('cancels/delete', 'AdminCancelReasonController@delete')->name('cancels.delete');
            /*================Admin Services control =========================*/
            Route::resource('services', 'AdminServicesController');
            Route::post('services/delete', 'AdminServicesController@delete')->name('services.delete');
            /*================Admin sub Services control =========================*/
            Route::resource('subServices', 'AdminSubServiceController');
            Route::post('subServices/delete', 'AdminSubServiceController@delete')->name('subServices.delete');
            /*================Admin sub sub Services control =========================*/
            Route::resource('subSubServices', 'AdminSubSubServiceController');
            Route::post('subSubServices/delete', 'AdminSubSubServiceController@delete')->name('subSubServices.delete');
            /*================Admin offers =========================*/
            Route::resource('offers', 'AdminOfferController');
            Route::post('offers/delete', 'AdminOfferController@delete')->name('offers.delete');
            /*================Admin workTime =========================*/
            Route::resource('workTimes', 'AdminWorkTimeController');
            Route::post('workTimes/delete', 'AdminWorkTimeController@delete')->name('workTimes.delete');
            /*================Admin DateTimes =========================*/
            Route::resource('dateTimes', 'AdminDateTimeController');
            Route::post('dateTimes/delete', 'AdminDateTimeController@delete')->name('dateTimes.delete');
            Route::get('dateTimes/active/{id}', 'AdminDateTimeController@is_active')->name('dateTimes.active');
            /*================Admin Question Controller =========================*/
            Route::resource('questions', 'QuestionController');
            Route::post('questions/delete', 'QuestionController@delete')->name('questions.delete');
            /*================Admin Orders Controller =========================*/
            Route::resource('orders', 'AdminOrderController');
            /*================Admin Coupons Controller =========================*/
            Route::resource('coupons', 'AdminCouponController');
            Route::post('coupons/delete', 'AdminCouponController@delete')->name('coupons.delete');
            Route::get('coupons/active/{id}', 'AdminCouponController@is_active')->name('coupons.active');
            /*================Admin Payments Controller =========================*/
            Route::resource('payments', 'AdminPaymentController');
            Route::get('payments/finish/{id}', 'AdminPaymentController@is_finish')->name('payments.finish');
            /*================Admin Prices control =========================*/
            Route::resource('prices', 'AdminPriceController');
            Route::post('prices/delete', 'AdminPriceController@delete')->name('prices.delete');
            /*=======================AdminDailyOrderCountController=================*/
            Route::resource('order-counts', 'AdminDailyOrderCountController');
            // Route::post('order-counts/delete','AdminDailyOrderCountController@delete')->name('prices.delete');
            /*=======================AdminMonthlyOrderCountController=================*/
            Route::resource('order-monthly', 'AdminMonthlyServiceController');
            Route::get('test', function () {
                return strtotime('6/5/2019');
            });
        });
        /*====================End Admin Panel==================*/
    });
});//end middleware of language
