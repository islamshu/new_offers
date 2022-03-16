<?php

namespace App\Http\Resources;

use App\Models\Country;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class SubResoures extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'type'=>$this->type_of_subscribe != null ? $this->type_of_subscribe : 'FREE',
            'points_no'=>$this->points_no,
            'store_points_no'=>$this->store_points_no,
            'offers_saving'=>$this->offers_saving,
            'coupons_saving'=>$this->coupon_saving,
            'used_offers_no'=>$this->used_offers_no,
            'purchases_no'=>$this->purchases_no,
            'credit'=>$this->getcridt($this),
            'remaining_credit'=> $this->getReman($this),
            'expire_date'=>$this->expricedate($this),
            'start_date'=>$this->startdate($this),
            'is_unlimited'=>$this->is_unlimited,
            'is_trial'=>$this->is_trial($this),
            
            'is_family'=>$this->is_family != 0 ? $this->is_family : null,
            'multiple_accounts_no'=>$this->multiple_accounts_no,
            'actual_accounts_no'=>$this->actual_accounts_no == null ? 0 : $this->actual_accounts_no,
        
        ];
    }
   
    function expricedate($data)
    {
       
        if(Carbon::now() > $data->expire_date ){

            return null;
        }else{
        return    date('Y-m-d', strtotime((string)$data->expire_date));
        }
    }
    function token_number($data)
    {
        // $array=[];
        // $data->tokens->each(function($token, $key) {
        //     array_push($array,$token);
        // });
        // return $array;
        
    }
    function startdate($data)
    {
        if($data->expire_date < Carbon::now()){
            return null;
        }else{
            return  date('Y-m-d', strtotime((string)$data->start_date));
        }
    }
    public function redeem(Request $request)
    {
        $user = auth('client_api')->user();
        if ($user->status != 'active') {
            $user->type_paid_user == 'free';
        }
        $type_paid_user = $user->subs->last()->subscripe->type_paid;
        $offer = Offer::find($request->offer_id);
        $vendor = Vendor::find($offer->vendor_id);
        if(!($vendor->qr_code == $request->store_pin_code || $request->store_pin_code == 'dbc4d84bfcfe2284ba11beffb853a8c4')){
            $res['status'] = $this->SendError();
                $res['status']['title'] = 'Purchase is Fail';
                $res['status']['message'] = 'The PIN code is wrong';
                return $res;
        }
        
        if (!$offer) {
            $res['status'] = $this->SendError();
            $res['status']['title'] = 'Purchase is Fail';
            $res['status']['message'] = 'Not Found Offer';
            return $res;
        }
        $enterprise = Vendor::find($offer->vendor_id)->enterprise_id;


        $numer_time =Transaction::where('offer_id',$request->offer_id)->where('client_id',auth('client_api')->id())->count();
        
        // dd($codes);
        $system_uses = $offer->usege_system;
        $client_uses = $offer->usege_member;


        $type_of_offer = $offer->member_type;

        if ($system_uses != 'unlimit') {
            if ($offer->usage_number_system <= $numer_time) {
                $res['status'] = $this->SendError();
                $res['message'] = 'System count is full error 2';
                return $res;
            }
        }
        if ($client_uses != 'unlimit') {
            if ($offer->usage_member_number <= $numer_time) {
                $res['status'] = $this->SendError();
                $res['status']['title'] = 'Purchase is Fail';
                $res['status']['message'] = 'The PIN code is wrong error 3';
                return $res;
            }
        }
        if (($type_of_offer == 'Premium' && $type_paid_user == 'PREMIUM') ||($type_of_offer == 'Premium' && $type_paid_user == 'TRIAL') || $type_of_offer == 'all' || ($type_of_offer == 'free' && $type_paid_user == 'TRIAL' || $type_paid_user == 'FREE' || $type_paid_user == 'PREMIUM' )) {


            if ($offer->usege_member == 'unlimit' || $offer->usage_member_number > $numer_time) {
                $ofe = new OfferUser();
                $ofe->offer_id = $request->offer_id;
                $ofe->vendor_id = $offer->vendor_id;
                $ofe->client_id = auth('client_api')->id();
                $ofe->branch_id = $request->branch_id;
                $user->purchases_no += 1;
                if($user->is_unlimited != 1){       
                if ($type_of_offer != 'free'  ) {
               
                    if ($user->remain > 0 && $user->remain != null) {
                        $user->remain = $user->remain - 1;
                    } else {
                        $res['status'] = $this->SendError();
                        $res['status']['title'] = 'Purchase is Fail';
                        $res['status']['message'] = 'The PIN code is wrong error 4';
                        return $res;
                    }
                }
            }
                if ($vendor->type_refound == 'auto') {
                    $ofe->referance_no = rand(000000000, 999999999);
                } else {
                    $codes = CodePermfomed::with('codes')->where('vendor_id', $request->store_id)->first()->codes->where('is_user', 0)->first();
                    $ofe->referance_no = $codes->code;
                    $f = Performed::where('code', $codes->code)->first();
                    $f->is_used = 1;
                    $f->save();
                }

                $ofe->save();
                $user->used_offers_no = $user->used_offers_no + 1;
                $user->save();
                $trans = new Transaction();
                $trans->client_id = auth('client_api')->id();
                $trans->offer_id = $request->offer_id;
                $trans->vendor_id = $offer->vendor_id;
                $trans->offer_id = $request->offer_id;
                $trans->branch_id = $request->branch_id;
                $trans->enterprise_id = $enterprise;
                $trans->refreance_number = $ofe->referance_no;
                $trans->price = $offer->price;
                $trans->offer_type = $offer->offertype->offer_type;
                $trans->save();
                $vendor->sales += 1;
                $vendor->save();
                $res['status'] = $this->sendResponse('Created');
                $res['status']['title'] = '';
                $res['status']['message'] = '';
                $res['data']["coupon"]['id'] = $ofe->id;
                $res['data']["coupon"]['offer_id'] = (int)$request->offer_id;
                $res['data']["coupon"]['branch_id'] = (int)$request->branch_id;
                $res['data']["coupon"]['store_id'] = (int)$offer->vendor_id;
                $res['data']["coupon"]['saving'] = 0;
                $res['data']["coupon"]['reference_no'] = (int)$ofe->referance_no;
                return $res;
            } else {
                $res['status'] = $this->SendError();
                $res['status']['title'] = 'Purchase is Fail';
                $res['status']['message'] = 'The PIN code is wrong error 5';
                return $res;
            }
        } else {

            $res['status'] = $this->SendError();
            $res['status']['title'] = 'Purchase is Fail';
            $res['status']['message'] = 'The PIN code is wrong error 6';
            return $res;
        }
    }
    function getcridt($data){
        if($data->expire_date < Carbon::now()){
            $data->type_of_subscribe = 'FREE';
            $data->save();
        }
        if($data->type_of_subscribe == 'FREE' || $data->type_of_subscribe == 'PREMIUM' ){
            return null;
        }elseif($data->type_of_subscribe == 'TRIAL'){
            
            return (int)$data->credit;
        }
    }  
    function is_trial($data){
        if($data->expire_date < Carbon::now()){
            $data->type_of_subscribe = 'FREE';
            $data->save();
        }
        // dd($data->type_of_subscribe);
        if($data->type_of_subscribe == 'FREE' || $data->type_of_subscribe == 'PREMIUM' ){
            return 0;
        }elseif($data->type_of_subscribe == 'TRIAL'){
            return 1;
        }
    }
}
