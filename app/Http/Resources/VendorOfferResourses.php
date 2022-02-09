<?php

namespace App\Http\Resources;

use App\Models\FavoritOffer;
use App\Models\Transaction;
use App\Models\Vendor;
use Illuminate\Http\Resources\Json\JsonResource;

class VendorOfferResourses extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return[
            'id'=>$this->offer->id,
            'name'=>$this->lang_name($this->offer),
            'details'=>$this->lang_details($this->offer),
            'terms'=>$this->lang_terms($this->offer),
            'image'=>asset('images/primary_offer/'.@$this->offer->offerimage->primary_image),
            'type'=>$this->typeoffer($this->offer),
            'membership_type'=>strtoupper($this->offer->member_type),
            'start_date'=>$this->offer->start_time,
            'expire_date'=>$this->offer->end_time,
            'before_price'=>$this->offer->offertype->price_befor_discount,
            'price'=> $this->offer->offertype->price != null ? $this->offer->offertype->price : 0 ,
            'percentage'=>$this->offer->offertype->discount_value != null ? $this->offer->offertype->discount_value : 0,
            'client_usage_times'=>$this->offer->usege_member  == 'unlimit' ? null : (int)$this->offer->usage_member_number ,
            'total_usage_times'=> $this->check($this->offer),
            'limit_period_duration'=>null,
            'limit_period_duration'=>null,
            'limit_period_unit'=>null,
            'points_no'=>$this->offer->system_point,
            'store_points_no'=>$this->offer->store_point,
            'is_general'=>0,
            'estimated_saving'=>0,
            'is_favorite'=>$this->is_fav($this->offer),
            'flash_deal'=> (int)$this->offer->is_flashdeal,
            'voucher'=> (int)$this->offer->is_voucher,
            'store_id'=> $this->offer->vendor_id ,
            'is_limited_period_between_redeems'=> 0,
            'period_limit_between_redeems'=> null,
            // 'last_use'=> $this->offer->Timetofferuse($this->offer),
            // 'uses_no'=>  $this->offer->Counttofferuse($this->offer),
            'distance'=>@$this->get_dinstance($this->offer,$request),
            'store'=> new VendorForOfferResourses($this->offer->vendor)  ,
        ];
    }
    public function check($data){
        if (auth('client_api')->check()) {
      $trans = Transaction::where('offer_id',$data->offer->id)->where('client_id',auth('client_api')->id())->count();
      return $trans;
        }else{
            return null;
        }
    }
    public function get_dinstance($data,$request)
    {
        $vendor = Vendor::find($data->offer->vendor_id);
        
        $array =[];
        foreach($vendor->branches as $branch){
            $value =  get_dinstance($request->latitude,$request->longitude,$branch->latitude,$branch->longitude);
             $di = $value  * 1.609344 ;
             array_push($array,$di);
         }
         if($array != null){
             return min($array);
         }
    }
    public function is_fav($data){
        $fav = FavoritOffer::where('offer_id',$data->offer->id)->where('user_id',auth()->id())->first();
        if($fav){
            return 1;
        }else{
            return 0;
        }
    }
    public function lang_name($data)
    {
        dd($data->offer);
        $lang = request()->header('Lang');
        if ($lang != null) {
            if ($lang  == 'ar') {
                return $data->offer->name_ar;
            } else {
                return $data->offer->name_en;
            }
        } else {
            return $data->offer->name_en;
        }
    }
    public function lang_details($data)
    {
        $lang = request()->header('Lang');
        if ($lang != null) {
            if ($lang  == 'ar') {
                return $data->offer->desc_ar;
            } else {
                return $data->offer->desc_en;
            }
        } else {
            return $data->offer->desc_en;
        }
    }
    public function lang_terms($data)
    {
        
        $array = [];
        $lang = request()->header('Lang');
        if ($lang != null) {
            if ($lang  == 'ar') {
             
               $items = explode('-',$data->offer->terms_ar);
            foreach($items as $key=>$i){
               array_push($array,$items[$key]);
             }
               return $array;

            } else {
               
                $items = explode('-',$data->offer->terms_en);
             foreach($items as $key=>$i){
                array_push($array,$items[$key]);
              }
                return $array;
            }
        } else {
          
            $items = explode('-',$data->offer->terms_en);
         foreach($items as $key=>$i){
            array_push($array,$items[$key]);
          }
            return $array;
        }
    }
    public function typeoffer($data){
        dd($data);
        if($data->offer->offertype->offer_type =='buyOneGetOne'){
            return 'buy_1_get_1';
        }elseif($data->offer->offertype->offer_type =='special_discount'){
            return 'special_discount';
        }elseif($data->offer->offertype->offer_type =='general_offer'){
            return 'general_discount';
        }
    }
}
