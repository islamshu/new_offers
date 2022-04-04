<?php

namespace App\Http\Resources;

use App\Models\Country;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class SubResouresPaid extends JsonResource
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
            'type'=>$this->get_user_type($this),
            'points_no'=>$this->points_no,
            'store_points_no'=>$this->store_points_no,
            'offers_saving'=>saving_offer($this->id),
            'coupons_saving'=>saving_offer($this->id),
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
    function get_user_type($data)
   {
       if($data->type_of_subscribe != null){
        if($data->type_of_subscribe == 'FREE' || $data->type_of_subscribe == 'Expir_premium' ){
            return 'FREE';
        }else{
            return $data->type_of_subscribe;
        }
       }else{
           return 'FREE';
       }
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
    function getReman($data){

        if($data->type_of_subscribe == 'FREE' || $data->type_of_subscribe == 'PREMIUM' || $data->type_of_subscribe == 'Expir_premium'  ){
            return null;
        }elseif($data->type_of_subscribe == 'TRIAL'){
            return (string)$data->remain;
        }

    }
    function getcridt($data){
      
        if($data->type_of_subscribe == 'FREE' || $data->type_of_subscribe == 'PREMIUM' || $data->type_of_subscribe == 'Expir_premium'  ){
            return null;
        }elseif($data->type_of_subscribe == 'TRIAL'){
            
            return (int)$data->credit;
        }
    }  
    function is_trial($data){
       
        // dd($data->type_of_subscribe);
        if($data->type_of_subscribe == 'FREE' || $data->type_of_subscribe == 'PREMIUM' || $data->type_of_subscribe == 'Expir_premium'  ){
            return 0;
        }elseif($data->type_of_subscribe == 'TRIAL'){
            return 1;
        }
    }
}
