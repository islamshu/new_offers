<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\VendorOfferDeResourses;

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
}
