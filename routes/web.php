<?php

use App\Http\Controllers\Authentication\AuthController;

use App\Http\Controllers\Dashboard\CityController;
use App\Http\Controllers\Dashboard\RoleController;
use App\Http\Controllers\Dashboard\NeighborhoodController;
use App\Http\Controllers\PagesController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
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

if (Auth::check()) {

    Route::get('/', function () {
        return redirect(url('en/dashboard/home'));
    });
} else {
    Route::get('/', function () {
        return redirect(url('en/dashboard/login'));
    })->name('get_login');
}


Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});
Route::group([
    'prefix' => '{locale}',
    'where' => ['locale' => '[a-zA-Z]{2}'],
    'middleware' => ['setlocale']
], function () {
    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        //Start Authentication Routes

        Route::group(['namespace' => 'Authentication'], function () {
            //----------Start Login Function
            Route::get('/login', [AuthController::class, 'getLogin'])->name('auth.login');
            Route::post('/login', [AuthController::class, 'postLogin'])->name('auth.login');
            //finish
        });
    });
    Route::group(['middleware' => ['checkrole:Admin']], function () {
        Route::resource('role', Dashboard\RoleController::class);
        Route::resource('permission', Dashboard\PermissionController::class);

    });
     Route::group(['middleware' => ['checkrole:Admin|Enterprises']], function () {
      

    });
    Route::group(['middleware' => ['checkrole:Admin|Vendors|Enterprises']], function () {
        //-----------------------Start Home Routes--------------------------

        Route::get('/home', [PagesController::class, 'index'])->name('home.index');
        
        Route::get('upload-brands', "Dashboard\brandController@get_import")->name('get.import');
        Route::get('dawnload-brands', "Dashboard\brandController@download")->name('download.brands');
        Route::get('end_subsss', "Dashboard\HomeController@end_subs");

        
        Route::post('import', "Dashboard\brandController@import")->name('post.import');
        Route::resource('country', Dashboard\CountryController::class);
        Route::resource('city', Dashboard\CityController::class);
        Route::resource('neighborhood', 'Dashboard\NeighborhoodController');
        Route::resource('vendor', Dashboard\brandController::class);
        Route::get('vendors/fetch_data', "Dashboard\brandController@fetch_data");
        Route::get('users_pagiante/fetch_data', "Dashboard\PortalController@fetch_data");
        Route::get('portall', "Dashboard\PortalController@index");
        Route::get('get_user_vendor/{id}', "Dashboard\PortalController@user_vendor")->name('get_user');
        Route::get('user_pan', "Dashboard\PortalController@panuser")->name('userpand.update');
        Route::get('set_Primary', "Dashboard\PortalController@set_Primary")->name('set_Primary.update');
        Route::get('get_detelis/{type}/{from}/{to}', "Dashboard\RepotController@get_detelis")->name('get_detelis');

        
        
        Route::get('get-citis',[NeighborhoodController::class, 'get_cites_by_country'])->name('get_cites_by_country.ajax');
        Route::get('get-countries-enterprise', "Dashboard\brandController@countriesAjax")->name('countriesAjax');
        Route::get('get-citis-vendor', 'Dashboard\branchController@vendorCitiesAjax')->name('vendorCitiesAjax');
        Route::get('get-Neighborhood-vendor', 'Dashboard\branchController@vendorNeighborhoodAjax')->name('vendorNeighborhoodAjax');
        Route::get('Enterprise-brand/{enterprise}', "Dashboard\brandController@Brands")->name('Brands-index');
        Route::resource('enterprise', Dashboard\EnterpriseController::class);
        Route::get('enterprise-show', "Dashboard\EnterpriseController@show_enterprice")->name('index-show');
        Route::post('update_enterprise/{id}',"Dashboard\EnterpriseController@updateEnterpise")->name('update-enterprise');
        Route::post('update_brand/{id}',"Dashboard\brandController@update_brand")->name('update-brand');
        Route::resource('branch', Dashboard\branchController::class);
        Route::get('branch_paginate',"Dashboard\branchController@fetch_data");

        Route::post('update_branch/{id}',"Dashboard\branchController@updateBranch")->name('update-branch');
        Route::get('country_vendor/{id}',"Dashboard\brandController@country_vendor")->name('country-vendor');
        Route::get('city_vendor/{id}',"Dashboard\brandController@city_vendor")->name('city-vendor');
        Route::get('neighborhoods_vendor/{id}',"Dashboard\brandController@neighborhoods_vendor")->name('neighborhoods-vendor');
        Route::get('neighborhoods_branch/{id}',"Dashboard\branchController@neighborhoods_branch")->name('neighborhoods-branch');
        Route::get('city_branch/{id}',"Dashboard\branchController@cityBranch")->name('city-branch');
        Route::resource('offers', Dashboard\OfferController::class);
        // Route::get('offers/fetch_data', "Dashboard\OfferController@fetch_data");
        Route::get('vendor_paginate',"Dashboard\OfferController@fetch_data")->name('dd');
        Route::post('update_offer/{id}',"Dashboard\OfferController@update_offer")->name('update-offer');
        Route::resource('subscription', Dashboard\SubscriptionController::class);
        Route::post('subscription-update/{id}',"Dashboard\SubscriptionController@update_subscription")->name('subscription-update');
        Route::resource('currency', 'Dashboard\CurrencyController');
        Route::post('currency-update/{id}',"Dashboard\CurrencyController@update_currency")->name('currency-update');
        Route::resource('category', 'Dashboard\CategoryController');
        Route::post('category-update/{id}',"Dashboard\CategoryController@update_category")->name('category-update');
        Route::get('get_brands','Dashboard\OfferController@get_brands')->name('get_brands');
        Route::get('get-get_category', 'Dashboard\CategoryController@get_category')->name('get_category');
        Route::get('logout','Authentication\AuthController@logout')->name('user.logout');
        Route::get('language_translate/{local}','Dashboard\HomeController@show_translate')->name('show_translate');
        Route::post('/languages/key_value_store', 'Dashboard\HomeController@key_value_store')->name('languages.key_value_store');
        Route::resource('user', 'Dashboard\UserController');
        Route::post('update-user/{id}', 'Dashboard\UserController@update_user')->name('update-user.user');
        Route::get('/category-update', 'Dashboard\CategoryController@updateStatus')->name('category.update');
        Route::get('/peffomed-status-update', 'Dashboard\PerfomedController@updateStatus')->name('pefromeds.update.status');
        Route::get('/vendor-cover/{id}', 'Dashboard\brandController@get_cover')->name('cover.show');
        Route::post('/vendor-cover', 'Dashboard\brandController@post_cover')->name('cover.post');
        Route::post('/show/category', 'Dashboard\brandController@showpostModal')->name('showpostModal');
        Route::post('/show/phone', 'Dashboard\RepotController@showphone')->name('showphone');
        Route::delete('/user_sub_delete/{id}', 'Dashboard\ClinetController@deletesub')->name('user_sub_delete.destroy');

        
        

        Route::post('/show/city_notofication', 'Dashboard\GeneralNotoficationController@model_city')->name('citynotofication');
        Route::post('/show/gendernotofication', 'Dashboard\GeneralNotoficationController@model_gender')->name('gendernotofication');
        Route::post('/resend/gendernotofication/{id}', 'Dashboard\GeneralNotoficationController@resend')->name('resend_gendernotofication');
        Route::get('/get_count', 'Dashboard\GeneralNotoficationController@get_count')->name('get_count');

        

        
        Route::post('/show/usermodel', 'Dashboard\brandController@showmodeluser')->name('showmodeluser');
        Route::post('/show/usermodelupdate', 'Dashboard\PortalController@updateuser')->name('updateuser');
        Route::post('/update_user_vendor', 'Dashboard\PortalController@updateusermodel')->name('update_user_vendor');
        Route::get('get_type_client','Dashboard\ClinetController@ftech_data')->name('get_type_client');
        Route::get('fetch_data_admin_client','Dashboard\RepotController@fetch_data_admin')->name('fetch_data_admin');
        Route::get('fetch_data_markinteming_client','Dashboard\RepotController@fetch_data_markinteming_client')->name('fetch_data_markinteming_client');
        Route::get('edit_popup/{city_id}/{id}','Dashboard\PremotionController@edit_popup')->name('edit_popup');
        Route::get('pop_status_update','Dashboard\PremotionController@pop_status_update')->name('popupstatus.update');

        
        Route::post('update_popup/{id}','Dashboard\PremotionController@update_popup')->name('update_popup');

        
        
        
        Route::post('/create_user_brand', 'Dashboard\UserController@create_user_brand')->name('create_user_brand');

        Route::get('/transaction_reports', 'Dashboard\RepotController@transaction')->name('transaction_sales');
        Route::get('/clients_reports', 'Dashboard\RepotController@clients')->name('clients_sales');
        Route::get('/clients_admin_reports', 'Dashboard\RepotController@clients_admin')->name('clients_sales_admin');
        Route::get('/marketing_client', 'Dashboard\RepotController@marketing_client')->name('marketing_client');


        Route::get('/offer_reports', 'Dashboard\RepotController@offers_reports')->name('offers_reports');

        Route::get('/all_user_not_sub', 'Dashboard\HomeController@all_user_not_sub')->name('all_user_not_sub');

        
        
        Route::get('/get_offer_ajax', 'Dashboard\PremotionController@get_offer_ajax')->name('get_offer_ajax');
        Route::get('/get_offer_ajax_not_slider', 'Dashboard\PremotionController@get_offer_ajax_not_slider')->name('get_offer_ajax_not_slider');
        Route::get('/get_branch_ajax', 'Dashboard\RepotController@get_branch_ajax')->name('get_branch_ajax');
        Route::get('/subscriprion_reports', 'Dashboard\RepotController@subscriprion_reports')->name('subscriprion_reports');
        Route::get('/get_reedem_for_user/{user}/{sub}', 'Dashboard\ClinetController@get_reedem_for_user')->name('get_reedem_for_user');

        Route::get('offer_status','Dashboard\OfferController@update_status')->name('offerstatus.update');
        
        Route::post('/get_modal/branch', 'Dashboard\branchController@get_modal')->name('showpostModalBranch');
        Route::post('send_client_notofication','Dashboard\ClinetController@send_client_notofication')->name('send_client_notofication');
        Route::post('add_sub_to_client','Dashboard\ClinetController@add_sub_to_client')->name('add_sub_to_client');
        Route::post('add_sub_for_user','Dashboard\ClinetController@add_sub_for_user')->name('add_sub_for_user');

        
        
        


        
        Route::delete('/vendor_cover/{id}', 'Dashboard\brandController@vendor_cover_delete')->name('vendor_cover.destroy');

        
        Route::resource('perfomeds', 'Dashboard\PerfomedController');
        Route::get('perfomed_fetch_data', 'Dashboard\PerfomedController@fetch_data')->name('perfomed_fetch_data');
        Route::get('offer_reports_fetch_data', 'Dashboard\RepotController@fetch_data')->name('offer_reports_fetch_data');

        
        Route::resource('sms_config', 'GeneralInfoController');
        Route::get('config', 'GeneralInfoController@config')->name('config.index');
        Route::get('myfatoorah_config', 'GeneralInfoController@myfatoorah')->name('myfatoorah_config.index');

        Route::get('firebase_config', 'GeneralInfoController@firebase')->name('firebase_config.index');

        Route::get('perfomeds_code/{vendor}', 'Dashboard\PerfomedController@get_perfomed_vendor')->name('vendor.get_perfomed_vendor');
        Route::get('perfomeds_code/{vendor}/{status}', 'Dashboard\PerfomedController@get_perfomed_vendor_code_status')->name('vendor.get_perfomed_vendor_status');

        
        Route::get('get_perfomed_vendor_code/{id}', 'Dashboard\PerfomedController@get_perfomed_vendor_code')->name('vendor.get_perfomed_vendor_code');
        Route::post('importCode', 'Dashboard\PerfomedController@Codeimport')->name('vendor.Codeimport');
        Route::post('pffertype_import', 'Dashboard\OfferController@pffertype_import')->name('pffertype_import');
        Route::get('get_import_type', 'Dashboard\OfferController@get_import_type');
        Route::get('offer_type_null', 'Dashboard\OfferController@offer_type_null');

        
        
        Route::get('vendor-offers/{id}', 'Dashboard\OfferController@offers')->name('vendor.offer');
        Route::get('create_offer/{id}', 'Dashboard\OfferController@create_offer')->name('vendor.create_offer');
        Route::get('vendor_update_status', 'Dashboard\brandController@updateStatus')->name('vednor.update.status');
        Route::get('branch_update_status', 'Dashboard\branchController@updateStatus')->name('bracnh.update.status');

        Route::get('vendor_branches/{id}', 'Dashboard\branchController@get_branches')->name('vendor.get_branch');
        Route::get('create_vendor_branches/{id}', 'Dashboard\branchController@create_branch')->name('vendor.create_branch');


        
        
        
        Route::resource('promotion', 'Dashboard\PremotionController');
        Route::delete('/home_slider/{id}', 'Dashboard\PremotionController@homeslider_delete')->name('homeslider.destroy');
        Route::delete('/delete_home_slider/{id}', 'Dashboard\PremotionController@delete_homeslider')->name('delete_homeslider.destroy');
        Route::delete('/delete_slider_promotion/{id}', 'Dashboard\PremotionController@delete_slider_promotion')->name('slider_promotion.destroy');
        Route::delete('/delete_popup/{id}', 'Dashboard\PremotionController@delete_popup')->name('delete_popup.destroy');

        Route::delete('/delete_paneer/{id}', 'Dashboard\PremotionController@delete_paneer')->name('delete_paneer.destroy');

        Route::get('get_user_not_sub1','Dashboard\HomeController@get_user_not_sub');
        Route::get('get_city_for_country/{type}/{id}', 'Dashboard\PremotionController@get_city_for_country')->name('get_city_for_country');
        Route::get('get_country_promotion/{type}', 'Dashboard\PremotionController@get_country_promotion')->name('get_country_promotion');
        Route::get('get_elemet_by_type/{type}/{city_id}', 'Dashboard\PremotionController@get_elemet_by_type')->name('get_elemet_by_type');
        Route::get('create_item/{type}/{city_id}', 'Dashboard\PremotionController@create_item')->name('create_item');
        Route::post('store_item/{type}/{city_id}', 'Dashboard\PremotionController@store_item')->name('store_item');
        Route::get('offer_slider/{id}/{city_id}', 'Dashboard\PremotionController@offer_slider')->name('offer_slider');
        Route::post('create_offer', 'Dashboard\PremotionController@create_offer')->name('create_offer');
        Route::get('change_color', 'Dashboard\PremotionController@change_color')->name('change_color');
        Route::post('send_notification','Dashboard\ClinetController@send_notification')->name('send_notification');
        Route::resource('privacy', 'PrivacyController');
        Route::resource('about_us', 'AboutController');
        Route::resource('termis', 'TermisController');
        Route::resource('How-it-work', 'HowItWorkController');
        Route::resource('faqs', 'FaqsController');
        Route::get('add_import_to_client','AboutController@add_import_to_client');
        Route::post('homeslider/update-order','Dashboard\PremotionController@updateOrder')->name('menu_update'); 
        Route::post('offer_slider/update-offer-order','Dashboard\PremotionController@menu_slideroffer')->name('menu_slideroffer'); 
        Route::post('update_cateory_sort','Dashboard\CategoryController@update_cateory_sort')->name('update_cateory_sort'); 
        Route::post('update_slider_sort','Dashboard\PremotionController@update_slider_sort')->name('update_slider_sort'); 
        Route::post('update_sort_offer','Dashboard\OfferController@update_sort')->name('update_sort_offer'); 
        Route::post('update_sort_about','AboutController@update_sort')->name('update_sort_about'); 
        Route::post('update_sort_privacy','PrivacyController@update_sort')->name('update_sort_privacy'); 
        Route::post('update_sort_term','TermisController@update_sort')->name('update_sort_term'); 
        Route::post('update_sort_faqs','FaqsController@update_sort')->name('update_sort_faqs'); 
        Route::get('social_info','SocialController@index'); 
        Route::post('social_info_post','SocialController@store')->name('social_info_post'); 

        
        
        
        
        Route::resource('coupun', 'Dashboard\CouponController');
        Route::get('get_vendor_promocode/{id}', 'Dashboard\CouponController@vednor_promocode')->name('vendor.get_copoun');

        Route::get('all_client', 'Dashboard\ClinetController@first_index');

        Route::get('show_clients/{type}','Dashboard\ClinetController@index')->name('show_clients');

        
        Route::get('import_client','Dashboard\ClinetController@get_import')->name('get_import');
        Route::post('import_client','Dashboard\ClinetController@post_import')->name('client.import');

        Route::resource('clinets', 'Dashboard\ClinetController');
        Route::resource('general_notofication', 'Dashboard\GeneralNotoficationController');
        Route::post('shownotoficationmodel', 'Dashboard\GeneralNotoficationController@shownotoficationmodel')->name('shownotoficationmodel');
        Route::post('update_notofication/{id}', 'Dashboard\GeneralNotoficationController@update_notofication')->name('update_notofication');

        Route::get('create_customs_notofication', 'Dashboard\GeneralNotoficationController@create_custom_notofication')->name('create_custom_notofication');
        Route::post('create_custom_notofication_post', 'Dashboard\GeneralNotoficationController@create_custom_notofication_post')->name('create_custom_notofication_post');

        Route::get('create_user_notofication', 'Dashboard\GeneralNotoficationController@create_user_notofication')->name('create_user_notofication');
        Route::get('create_city_notofication', 'Dashboard\GeneralNotoficationController@create_city_notofication')->name('create_city_notofication');
        Route::get('create_gender_notofication', 'Dashboard\GeneralNotoficationController@create_gender_notofication')->name('create_gender_notofication');

        
        Route::post('store_city_notofication', 'Dashboard\GeneralNotoficationController@store_city')->name('store_city_noto');
        Route::post('store_gender_notofication', 'Dashboard\GeneralNotoficationController@store_gender')->name('store_gender_noto');

        
        Route::post('store_user_notofication', 'Dashboard\GeneralNotoficationController@store_user_notofication')->name('store_user_notofication');

        Route::get('create_coupun/{id}','Dashboard\CouponController@create_coupon')->name('vendor.create_coupoun');
        

        Route::resource('code', 'Dashboard\CodeController');
        Route::get('used_code/{id}', 'Dashboard\CodeController@used_code')->name('used_code');
        Route::get('not_used_code/{id}', 'Dashboard\CodeController@not_used_code')->name('not_used_code');
        Route::get('export_code/{type_used}/{id}', 'Dashboard\CodeController@export_code')->name('export_code');

        Route::resource('discount_code', 'Dashboard\DiscountController');   
        Route::get('discount_code_user/{code}', 'Dashboard\DiscountController@user')->name('user_promo');   

        
        Route::post('update-discount/{id}', 'Dashboard\DiscountController@update_code')->name('update-code.discountcode');
        Route::get('show_promocode','Dashboard\DiscountController@showCodes')->name('showCodes');
        Route::get('show_promocode_user','Dashboard\DiscountController@showCodesUser')->name('showCodesUser');

        
        Route::post('update-code/{id}', 'Dashboard\CodeController@update_code')->name('update-code.code');

        Route::post('update-coupun/{id}', 'Dashboard\CouponController@update_coupun')->name('update-coupun.coupun');
        Route::get('export-category','Dashboard\CategoryController@export')->name('export.category');
        Route::get('index_sub/{id}','Dashboard\SubscriptionController@index_sub');

        Route::get('currency_update/update_status','Dashboard\CurrencyController@updateStatus')->name('currency.update_status');
        Route::get('city_update/update_status','Dashboard\CityController@updateStatus')->name('city.update_status');
        Route::get('city_update/update_status','Dashboard\CityController@update_enterprice_Status')->name('enter_pricecity.update_status');
        Route::get('neighborhood_update/update_status','Dashboard\NeighborhoodController@updateStatus')->name('neighborhood.update_status');
        Route::get('neighborhood_enterprice_update/update_status','Dashboard\NeighborhoodController@update_enterprice_Status')->name('neighborhood_enterprice.update_status');
        Route::get('coipoun/update_status','Dashboard\CouponController@updateStatus')->name('coupon.update_status');
        Route::get('create_paid_subsrcibe','Dashboard\SubscriptionController@create_paid_subsrcibe')->name('create_paid_subsrcibe.subscribe');
        Route::get('create_trial_subsrcibe','Dashboard\SubscriptionController@create_trial_subsrcibe')->name('create_trial_subsrcibe.subscribe');
        Route::get('subscibe_update/update_status','Dashboard\SubscriptionController@updateStatus')->name('subscipe.update_status');
        Route::get('code_update/update_status','Dashboard\CodeController@updateStatus')->name('code.update_status');
        Route::get('discount_update/update_status','Dashboard\DiscountController@updateStatus')->name('discount.update_status');
        Route::post('import_branch/{id}','Dashboard\branchController@import')->name('importBranch');
        Route::get('download/branches','Dashboard\branchController@download')->name('download.branches');
        Route::post('import_offer/{id}','Dashboard\OfferController@import')->name('importOffer');
        Route::post('/get_modal/offer', 'Dashboard\OfferController@get_modal')->name('showpostModalOffer');
        Route::get('download/codes','Dashboard\PerfomedController@download')->name('download.code');

        Route::resource('transaction','Dashboard\TransactionController');   
        

        
    });
});

 

Route::get('/datatables', 'PagesController@datatables');
Route::get('/ktdatatables', 'PagesController@ktDatatables');
Route::get('/select2', 'PagesController@select2');
Route::get('/icons/custom-icons', 'PagesController@customIcons');
Route::get('/icons/flaticon', 'PagesController@flaticon');
Route::get('/icons/fontawesome', 'PagesController@fontawesome');
Route::get('/icons/lineawesome', 'PagesController@lineawesome');
Route::get('/icons/socicons', 'PagesController@socicons');
Route::get('/icons/svg', 'PagesController@svg');
Route::get('test/test/twea', 'GeneralInfoController@test');
Route::get('/quick-search', 'PagesController@quickSearch')->name('quick-search');
Route::get('lang/{local}', 'Dashboard\HomeController@lang')->name('change.lang');
