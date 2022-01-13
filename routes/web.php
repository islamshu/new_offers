<?php

use App\Http\Controllers\Authentication\AuthController;

use App\Http\Controllers\Dashboard\CityController;
use App\Http\Controllers\Dashboard\RoleController;
use App\Http\Controllers\Dashboard\NeighborhoodController;
use App\Http\Controllers\PagesController;
use Illuminate\Support\Facades\Auth;
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

        Route::post('import', "Dashboard\brandController@import")->name('post.import');
        Route::resource('country', Dashboard\CountryController::class);
        Route::resource('city', Dashboard\CityController::class);
        Route::resource('neighborhood', 'Dashboard\NeighborhoodController');
        Route::resource('vendor', Dashboard\brandController::class);
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
        Route::post('update_branch/{id}',"Dashboard\branchController@updateBranch")->name('update-branch');
        Route::get('country_vendor/{id}',"Dashboard\brandController@country_vendor")->name('country-vendor');
        Route::get('city_vendor/{id}',"Dashboard\brandController@city_vendor")->name('city-vendor');
        Route::get('neighborhoods_vendor/{id}',"Dashboard\brandController@neighborhoods_vendor")->name('neighborhoods-vendor');
        Route::get('neighborhoods_branch/{id}',"Dashboard\branchController@neighborhoods_branch")->name('neighborhoods-branch');
        Route::get('city_branch/{id}',"Dashboard\branchController@cityBranch")->name('city-branch');
        Route::resource('offers', Dashboard\OfferController::class);
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
        Route::get('/get_offer_ajax', 'Dashboard\PremotionController@get_offer_ajax')->name('get_offer_ajax');

        


        
        Route::delete('/vendor_cover/{id}', 'Dashboard\brandController@vendor_cover_delete')->name('vendor_cover.destroy');
        Route::resource('perfomeds', 'Dashboard\PerfomedController');
        Route::get('perfomeds_code/{vendor}', 'Dashboard\PerfomedController@get_perfomed_vendor')->name('vendor.get_perfomed_vendor');
        Route::get('perfomeds_code/{vendor}/{status}', 'Dashboard\PerfomedController@get_perfomed_vendor_code_status')->name('vendor.get_perfomed_vendor_status');

        
        Route::get('get_perfomed_vendor_code/{id}', 'Dashboard\PerfomedController@get_perfomed_vendor_code')->name('vendor.get_perfomed_vendor_code');
        Route::post('importCode', 'Dashboard\PerfomedController@Codeimport')->name('vendor.Codeimport');
        Route::get('vendor-offers/{id}', 'Dashboard\OfferController@offers')->name('vendor.offer');
        Route::get('create_offer/{id}', 'Dashboard\OfferController@create_offer')->name('vendor.create_offer');
        Route::get('vendor_update_status', 'Dashboard\brandController@updateStatus')->name('vednor.update.status');
        Route::get('branch_update_status', 'Dashboard\branchController@updateStatus')->name('bracnh.update.status');

        Route::get('vendor_branches/{id}', 'Dashboard\branchController@get_branches')->name('vendor.get_branch');
        Route::get('create_vendor_branches/{id}', 'Dashboard\branchController@create_branch')->name('vendor.create_branch');


        
        
        
        Route::resource('promotion', 'Dashboard\PremotionController');
        
        Route::get('get_city_for_country/{type}/{id}', 'Dashboard\PremotionController@get_city_for_country')->name('get_city_for_country');
        Route::get('get_country_promotion/{type}', 'Dashboard\PremotionController@get_country_promotion')->name('get_country_promotion');
        Route::get('get_elemet_by_type/{type}/{city_id}', 'Dashboard\PremotionController@get_elemet_by_type')->name('get_elemet_by_type');
        Route::get('create_item/{type}/{city_id}', 'Dashboard\PremotionController@create_item')->name('create_item');
        Route::post('store_item/{type}/{city_id}', 'Dashboard\PremotionController@store_item')->name('store_item');
        Route::get('offer_slider/{id}', 'Dashboard\PremotionController@offer_slider')->name('offer_slider');
        Route::post('create_offer', 'Dashboard\PremotionController@create_offer')->name('create_offer');

        
        
        
        Route::resource('coupun', 'Dashboard\CouponController');
        Route::get('get_vendor_promocode/{id}', 'Dashboard\CouponController@vednor_promocode')->name('vendor.get_copoun');

        
        Route::resource('clinets', 'Dashboard\ClinetController');
        Route::resource('general_notofication', 'Dashboard\GeneralNotoficationController');
        Route::get('create_user_notofication', 'Dashboard\GeneralNotoficationController@create_user_notofication')->name('create_user_notofication');
        Route::post('store_user_notofication', 'Dashboard\GeneralNotoficationController@store_user_notofication')->name('store_user_notofication');

        
        

        Route::resource('code', 'Dashboard\CodeController');
        Route::post('update-code/{id}', 'Dashboard\CodeController@update_code')->name('update-code.code');

        Route::post('update-coupun/{id}', 'Dashboard\CouponController@update_coupun')->name('update-coupun.coupun');
        Route::get('export-category','Dashboard\CategoryController@export')->name('export.category');
        Route::get('index_sub/{value}','Dashboard\SubscriptionController@index_sub')->name('index_sub.subscribe');
        Route::get('currency_update/update_status','Dashboard\CurrencyController@updateStatus')->name('currency.update_status');
        Route::get('city_update/update_status','Dashboard\CityController@updateStatus')->name('city.update_status');
        Route::get('city_update/update_status','Dashboard\CityController@update_enterprice_Status')->name('enter_pricecity.update_status');
        Route::get('neighborhood_update/update_status','Dashboard\NeighborhoodController@updateStatus')->name('neighborhood.update_status');
        Route::get('neighborhood_enterprice_update/update_status','Dashboard\NeighborhoodController@update_enterprice_Status')->name('neighborhood_enterprice.update_status');

        
        
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

Route::get('/quick-search', 'PagesController@quickSearch')->name('quick-search');
Route::get('lang/{local}', 'Dashboard\HomeController@lang')->name('change.lang');
