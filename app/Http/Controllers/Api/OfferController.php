<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\MapOfferResourses;
use App\Http\Resources\OfferCollection;
use App\Http\Resources\PakegeCollection;
use App\Http\Resources\SocialCollection;
use App\Http\Resources\SuggetstedOfferResourses;
use App\Http\Resources\VednorResourse;
use App\Http\Resources\VendorCoverCollection;
use App\Http\Resources\VendorDetiesResourses;
use App\Http\Resources\VendorOfferDeResourses;
use App\Models\Social;
use App\Models\Subscription;
use App\Models\Vendor;

class OfferController extends BaseController
{
    public function offerDetiles(Request $request){
        $offer= Offer::find($request->offer_id);
        if($offer){
            $res['status']= $this->sendResponse('OK');
            $res['data'] = new VendorOfferDeResourses($offer);
            return $res;
        }else{
            $res['status']= $this->SendError();
            return $res;
        }
        
    }
    public function package(Request $request){
        $pakege = Subscription::with('vendor')->whereHas('vendor', function ($q) use ($request) {
           
                 $q->with('counteire')->whereHas('counteire', function ($q) use ($request) {
                    $q->where('country_id', $request->country_id);
                  });
                })->with('enteprice')->orWhereHas('enteprice', function ($q) use ($request) {
           
                    $q->with('counteire')->whereHas('counteire', function ($q) use ($request) {
                       $q->where('country_id', $request->country_id);
                     });
        })->get();
        $res['status']= $this->sendResponse('OK');
        $res['data'] = new PakegeCollection($pakege);
        return $res;
    }
    public function contact(){
        $socials = Social::get();
        $res['status']= $this->sendResponse('OK');
        $res['data'] = new SocialCollection($socials);
        return $res;
    }
    public function search(Request $request){
        // $socials = Social::get();
        $res['status']= $this->sendResponse('OK');
        $offers = Offer::with('vendor')->whereHas('vendor', function ($q) use ($request) {
            $q->with('cities')->whereHas('cities', function ($q) use ($request) {
                   $q->where('city_id', $request->city_id);
                 }); 
                 })->where('name_ar','like','%'.$request->search_key.'%')->orWhere('name_en','like','%'.$request->search_key.'%')->get();

        $stores = Vendor::with('cities')->whereHas('cities', function ($q) use ($request) {
            $q->where('city_id', $request->city_id);
          }) 
        ->where('name_ar','like','%'.$request->search_key.'%')->orWhere('name_en','like','%'.$request->search_key.'%')->get();

        $res['data']['offers'] = new OfferCollection($offers);
        $res['data']['stores'] =  VednorResourse::collection($stores);

        return $res;
    }
    public function suggetstd_offer(Request $request)
    {
        $offers = Offer::with('vendor')->whereHas('vendor', function ($q) use ($request) {
            $q->with('cities')->whereHas('cities', function ($q) use ($request) {
                   $q->where('city_id', $request->city_id);
                 }); 
                 })->inRandomOrder()->get();
                 $res['status']= $this->sendResponse('OK');
                 $res['data'] = SuggetstedOfferResourses::collection($offers);
                 return $res;
    }
    public function offer_map(Request $request)
    {
        $offers = Offer::with('vendor')->whereHas('vendor', function ($q) use ($request) {
            $q->with('cities')->whereHas('cities', function ($q) use ($request) {
                   $q->where('city_id', $request->city_id);
                 }); 
                 })->get();
                 $res['status']= $this->sendResponse('OK');
                 $res['data'] = MapOfferResourses::collection($offers);
                 return $res;
    }
}
