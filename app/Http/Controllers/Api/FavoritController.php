<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FavoritVendor;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\FavoritCollection;
use App\Http\Resources\FavoritOfferCollection;
use App\Models\FavoritOffer;
use App\Models\Offer;
use App\Models\Vendor;

class FavoritController extends BaseController
{
    public function AddOrRemoveStoreFavorit(Request $request)
    {
        $vendor = Vendor::find($request->vendor_id);
        if ($vendor) {
            $fav =  FavoritVendor::where('user_id', auth()->id())->where('vendor_id', $request->vendor_id)->first();
            if ($fav) {
                $fav->delete();
                $res['status'] = $this->sendResponse('Deleted');
                $res['data'][''] = "";
            } else {
                $fav = new FavoritVendor();
                $fav->user_id = auth()->id();
                $fav->vendor_id = $request->vendor_id;
                $fav->save();
                $res['status'] = $this->sendResponse('Created');
                $res['data'][''] = "";
            }
            return $res;
        } else {
            $res['status'] = $this->SendError();
            return $res;
        }
    }
    public function store_favorite(Request $request)
    {
        $fav = FavoritVendor::where('user_id', auth()->id())->paginate($request->paginate);
        $res['status'] = $this->sendResponse('Ok');
        $res['data'] = new FavoritCollection($fav);
        return $res;
    }
    public function AddOrRemoveOfferFavorit(Request $request)
    {
        $vendor = Offer::find($request->offer_id);
        if ($vendor) {
            $fav =  FavoritOffer::where('user_id', auth()->id())->where('offer_id', $request->offer_id)->first();
            if ($fav) {
                $fav->delete();
                $res['status'] = $this->sendResponse('Deleted');
                $res['data'][''] = "";
            } else {
                $fav = new FavoritOffer();
                $fav->user_id = auth()->id();
                $fav->offer_id = $request->offer_id;
                $fav->save();
                $res['status'] = $this->sendResponse('Created');
                $res['data'][''] = "";
            }
            return $res;
        } else {
            $res['status'] = $this->SendError();
            return $res;
        }
    }
    public function offer_favorite(Request $request)
    {
        $fav = FavoritOffer::where('user_id', auth()->id())->paginate($request->paginate);
        $res['status'] = $this->sendResponse('Ok');
        $res['data'] = new FavoritOfferCollection($fav);
        return $res;
    }
}
