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

Route::Post('login-request/{ent_id}','Api\UserController@login');
Route::get('country','Api\HomeController@country');
Route::post('city','Api\HomeController@city');
Route::post('verification-code/check','Api\UserController@verification_code');
Route::get('home','Api\HomeController@home');

// verification-code/check

Route::group(['middleware'=>'auth:api'], function(){
    Route::get('client/info','Api\UserController@user_info');
    Route::post('store-favorite-add-or-delete','Api\FavoritController@AddOrRemoveStoreFavorit');
    Route::get('store-favorite','Api\FavoritController@store_favorite');
    Route::post('offer-favorite-add-or-delete','Api\FavoritController@AddOrRemoveOfferFavorit');
    Route::get('offer-favorite','Api\FavoritController@offer_favorite');
    Route::get('vendor-list','Api\HomeController@vendor_list');
    Route::get('vendor','Api\HomeController@vendor_detels');
    Route::get('store/branches','Api\HomeController@vendor_branches');
    Route::get('store/offers','Api\HomeController@vendor_offers');
    Route::get('store/reviews','Api\HomeController@vendor_reviews');
    Route::get('nearby-partners','Api\HomeController@nearby_partners');

    
  

    
    

    
    
});

// });
Route::get('header_token', function() {
    $response['status'] = ['status' => false,'HTTP_code'=>404,'HTTP_response'=>'Unauthorized', 'message' => 'Unauthorized or Signed in from another device'];
    return $response; 
 })->name('header_token');