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
// Route::group(['middleware' => ['is_login']], function () {

Route::Post('login-request', 'Api\UserController@login');
Route::get('country', 'Api\HomeController@country');
Route::get('city', 'Api\HomeController@city');
Route::post('verification-code/check', 'Api\UserController@verification_code');
Route::get('home', 'Api\HomeController@home');
Route::get('privacy-policy', 'Api\PageController@privacy');
Route::get('term-and-condition', 'Api\PageController@terms');
Route::get('about-us', 'Api\PageController@abouts');
Route::get('FAQs','Api\PageController@faqs');
Route::get('how-it-work', 'Api\PageController@works');
Route::get('vendor-list', 'Api\HomeController@vendor_list');
Route::get('vendor', 'Api\HomeController@vendor_detels');

// verification-code/check

Route::group(['middleware' => 'auth:client_api'], function () {
    Route::group(['middleware' => 'devide'], function () {
        Route::get('client/info', 'Api\UserController@user_info');
        Route::post('store-favorite-add-or-delete', 'Api\FavoritController@AddOrRemoveStoreFavorit');
        Route::get('store-favorite', 'Api\FavoritController@store_favorite');
        Route::post('offer-favorite-add-or-delete', 'Api\FavoritController@AddOrRemoveOfferFavorit');
        Route::get('offer-favorite', 'Api\FavoritController@offer_favorite');
        Route::get('vendor', 'Api\HomeController@vendor_detels');
        Route::get('store/branches', 'Api\HomeController@vendor_branches');
        Route::get('store/offers', 'Api\HomeController@vendor_offers');
        Route::get('store/reviews', 'Api\HomeController@vendor_reviews');
        Route::get('nearby-partners', 'Api\HomeController@nearby_partners');
        Route::get('offer', 'Api\OfferController@offerDetiles');
        Route::get('package', 'Api\OfferController@package');
        Route::get('contact', 'Api\OfferController@contact');
        Route::get('search', 'Api\OfferController@search');
        Route::post('contact-us-support-message', 'Api\HomeController@post_support');
        Route::get('contact-us-support-message', 'Api\HomeController@get_support');
        Route::post('contact/create', 'Api\HomeController@contact_us');
        Route::get('profile', 'Api\HomeController@profile');
        Route::get('suggestion-offer', 'Api\OfferController@suggetstd_offer');
        Route::get('offers-map', 'Api\OfferController@offer_map');
        Route::post('package/activation', 'Api\CodeController@sub_by_activiton');
        Route::post('apply-promo-code', 'Api\CodeController@apply_promo_code');
        Route::post('redeem', 'Api\CodeController@redeem');
        Route::put('client/update/info', 'Api\UserController@update');
        Route::put('client/update/city', 'Api\UserController@update_city');
        Route::post('client/image/update', 'Api\UserController@update_image');

    });
});

// });
Route::get('header_token', function () {
    $response['status'] = ['status' => false, 'HTTP_code' => 404, 'HTTP_response' => 'Unauthorized', 'message' => 'Unauthorized or Signed in from another device'];
    return $response;
})->name('header_token');
