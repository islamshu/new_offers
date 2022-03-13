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
            'start_date'=>date('Y-m-d', strtotime((string)$this->start_date)),
            'is_unlimited'=>$this->is_unlimited,
            'is_trial'=>$this->is_trial($this),
            
            'is_family'=>$this->is_family != 0 ? $this->is_family : null,
            'multiple_accounts_no'=>$this->multiple_accounts_no,
            'actual_accounts_no'=>$this->actual_accounts_no == null ? 0 : $this->actual_accounts_no 
        
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
    function startdate($data)
    {
        if(Carbon::now() > $data->expire_date ){
            return null;
        }else{
            return  date('Y-m-d', strtotime((string)$data->start_date));
        }
    }
    function getReman($data){

        if($data->expire_date < Carbon::now()){
            $data->type_of_subscribe = 'FREE';
            $data->save();
        }
        if($data->type_of_subscribe == 'FREE' || $data->type_of_subscribe = 'PREMIUM' ){
            return null;
        }elseif($data->type_of_subscribe == 'TRIAL'){
            return (string)$data->remain;
        }

    }
    function getcridt($data){
        if($data->expire_date < Carbon::now()){
          
            $data->type_of_subscribe = 'FREE';
            $data->save();
        }
        if($data->type_of_subscribe == 'FREE' || $data->type_of_subscribe = 'PREMIUM' ){
            return null;
        }elseif($data->type_of_subscribe == 'TRIAL'){
            return (string)$data->credit;
        }
    }  
    function is_trial($data){
        if($data->expire_date < Carbon::now()){
            $data->type_of_subscribe = 'FREE';
            $data->save();
        }
        dd($data->type_of_subscribe);
        if($data->type_of_subscribe == 'FREE' || $data->type_of_subscribe == 'PREMIUM' ){
            return 0;
        }elseif($data->type_of_subscribe == 'TRIAL'){
            return 1;
        }
    }
}
