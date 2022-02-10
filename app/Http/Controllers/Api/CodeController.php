<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController;
use App\Models\Code;
use App\Models\CodePermfomed;
use App\Models\CodeSubscription;
use App\Models\Discount;
use App\Models\Offer;
use App\Models\OfferUser;
use App\Models\Performed;
use App\Models\Subscription;
use App\Models\Subscriptions_User;
use App\Models\Transaction;
use App\Models\Vendor;
use Carbon\Carbon;

class CodeController extends BaseController
{
    public function sub_by_activiton(Request $request){
        // dd(auth('client_api')->id());

        $code = Subscription::with('codes')->whereHas('codes', function ($q) use ($request) {
            $q->where('code',$request->activation_code);
        })->first();
        // dd($code);
        if(!$code){
            $res['status']= $this->SendError();
            return $res;
        }
        $count = Subscriptions_User::where('clinet_id',auth('client_api')->id())->where('sub_id',$code->id)->count();
        $user = new Subscriptions_User();
        $user->payment_type = 'activition_code';
        // dd(auth('client_api')->id());
        $client = auth('client_api')->user();
        $client->type_of_subscribe = $code->type_paid;
        $client->credit= $code->balance;
        $client->save();
        $data_type = $code->expire_date_type;
        $data_type_number = $code->number_of_dayes;
        if($data_type == 'days'){
            $user->expire_date = Carbon::now()->addDays($data_type_number);
        }elseif($data_type == 'months'){
            $user->expire_date = Carbon::now()->addMonths($data_type_number);
        }elseif($data_type == 'years'){
            $user->expire_date = Carbon::now()->addYears($data_type_number);
        }
        $user->status = 'active';
        $user->balnce = $code->balance;
        $user->purchases_no =  $count+1;
        $user->sub_id  = $code->id;
        $user->clinet_id  = auth('client_api')->id();
        $user->save();
        $codesub = CodeSubscription::where('code',$request->activation_code)->first();
        $codesub->is_used = 1;
        $codesub->save();
        $res['status']= $this->sendResponse('OK');
        $res['data'][""] = "";
        return $res;
    }
    public function redeem(Request $request){
        $user = auth('client_api')->user();
        if($user->status !='active'){
            $user->type_paid_user == 'free';
        }
        $type_paid_user = $user->subs->last()->subscripe->type_paid;
        $offer = Offer::find($request->offer_id);
        if(!$offer){
            $res['status']= $this->SendError();
            $res['message']= 'the is no offer here';
            return $res;
        }
        $enterprise = Vendor::find($offer->vendor_id)->enterprise_id;
      
       
        $numer_time = OfferUser::where('client_id',$user->id)->count();
        $codes = CodePermfomed::with('codes')->where('vendor_id',$request->store_id)->first()->codes->where('is_user',0)->first();
        // dd($codes);
        $system_uses = $offer->usege_system;
        $client_uses = $offer->usege_member;

        
        $type_of_offer = $offer->member_type;
        
        if($system_uses != 'unlimit'){
            if($offer->usage_number_system <= $numer_time  ){
                $res['status']= $this->SendError();
                $res['message']= 'System count is full';
                return $res;
            }
        } 
        if($client_uses != 'unlimit'){
            if($offer->usage_member_number <= $numer_time  ){
                $res['status']= $this->SendError();
                $res['message']= 'user count is full';
                return $res;
            }
        }
        if(($type_of_offer == 'paid' && $type_paid_user =='trial') || $type_of_offer == 'all' || ($type_of_offer == 'free' && $type_paid_user =='trial'  )){
            

        if( $offer->usege_member == 'unlimit' || $offer->usage_member_number > $numer_time){
            $ofe = new OfferUser();
            $ofe->offer_id = $request->offer_id;
            $ofe->vendor_id = $offer->vendor_id;
            $ofe->client_id = auth('client_api')->id();
            $ofe->branch_id = $request->branch_id;
            if($type_of_offer != 'free' ){
                if($user->remain > 0){
                $user->remain = $user->remain - 1;
            }else{
                $res['status']= $this->SendError();
                $res['message']= 'no balance in uer account';
                return $res;
            }
            }
            if($offer->type_refound == 'auto'){
                $ofe->referance_no = rand(00000,99999); 
            }else{
                $ofe->referance_no = $codes->code;
                $f = Performed::where('code',$codes->code)->first();
                $f->is_used = 1;
              

            }
            $f->save();
            $ofe->save();
            $user->used_offers_no = $user->used_offers_no +1;
            $user->save();
            $trans = new Transaction();
            $trans -> client_id = auth('client_api')->id();
            $trans->offer_id = $request->offer_id;
            $trans->vendor_id = $offer->vendor_id;
            $trans->offer_id = $request->offer_id;
            $trans->branch_id = $request->branch_id;
            $trans->enterpise_id = $enterprise;
            $trans->refreance_number = $ofe->referance_no ;
            $trans->save();
            $res['status']= $this->sendResponse('OK');
            $res['data']["coupon"]['id'] = $ofe->id;
            $res['data']["coupon"]['offer_id'] =$request->offer_id;
            $res['data']["coupon"]['branch_id'] =$offer->vendor_id;
            $res['data']["coupon"]['store_id'] =$request->branch_id;
            $res['data']["coupon"]['referance_no'] = $codes->code;
            return $res;
        }else{
            $res['status']= $this->SendError();
            $res['message']= 'He cannot participate in the offer because the offer does not fit the account';
            return $res;
        }
    }else{

     $res['status']= $this->SendError();
    $res['message']= 'type of supsription not allowed';
    return $res; 
}

        
        
       
    }
    public function apply_promo_code(Request $request){
        $code = Subscription::with('promo')->whereHas('promo', function ($q) use ($request) {
            $q->where('code',$request->code);
        })->first();
        $discout = Discount::find($code->promo->first()->discount_id);
        $discout_type = $discout->type_discount;
        $discout_value = $discout->value_discount;
        $price = $code->price;

        $res['status']= $this->sendResponse('OK');
        $res['data']["orgin_price"] = $price;
        $res['data']["discout_type"] = $discout_type;
        $res['data']["discout_value"] = $discout_value;
        if($discout_type == 'percentage'){
       $total =     $price -  ($price * $discout_value / 100);
        }else{
            $total =     $price -  $discout_value;
        }
        $res['data']["price_descount"] = $total;
        return $res;
    }
}
