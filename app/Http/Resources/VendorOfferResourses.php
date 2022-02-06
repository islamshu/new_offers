<?php

namespace App\Http\Resources;

use App\Models\FavoritOffer;
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
            'id'=>$this->id,
            'name'=>$this->lang_name($this),
            'details'=>$this->lang_details($this),
            'terms'=>$this->lang_terms($this),
            'image'=>asset('images/primary_offer/'.@$this->offerimage->primary_image),
            'type'=>$this->offer_type,
            'membership_type'=>$this->member_type,
            'start_date'=>$this->start_time,
            'expire_date'=>$this->end_time,
            'before_price'=>'',
            'price'=> 0,
            'client_usage_times'=> $this->usege_member,
            'total_usage_times'=> $this->usege_system,
            'limit_period_duration'=>null,
            'limit_period_duration'=>null,
            'limit_period_unit'=>null,
            'points_no'=>$this->system_point,
            'store_points_no'=>$this->store_point,
            'is_general'=>0,
            'estimated_saving'=>0,
            'is_favorite'=>$this->is_fav($this),
            'percentage'=> null,
            'flash_deal'=> $this->is_flashdeal,
            'voucher'=> $this->is_voucher,
            'store_id'=> $this->vendor_id ,
            'distance'=>@$this->get_dinstance($this,$request),
            'store'=> new VendorForOfferResourses($this->vendor)  ,
        ];
    }
    public function get_dinstance($data,$request)
    {
        $vendor = Vendor::find($data->vendor_id);
        
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
        $fav = FavoritOffer::where('offer_id',$data->id)->where('user_id',auth()->id())->first();
        if($fav){
            return 1;
        }else{
            return 0;
        }
    }
    public function lang_name($data)
    {
        $lang = request()->header('Lang');
        if ($lang != null) {
            if ($lang  == 'ar') {
                return $data->name_ar;
            } else {
                return $data->name_en;
            }
        } else {
            return $data->name_en;
        }
    }
    public function lang_details($data)
    {
        $lang = request()->header('Lang');
        if ($lang != null) {
            if ($lang  == 'ar') {
                return $data->desc_ar;
            } else {
                return $data->desc_en;
            }
        } else {
            return $data->desc_en;
        }
    }
    public function lang_terms($data)
    {
        
    
        $lang = request()->header('Lang');
        if ($lang != null) {
            if ($lang  == 'ar') {
                $array = [];
               $items = explode('\n',$data->terms_ar);
               dd($items);
               return $array;

            } else {
                return nl2br($data->terms_en);
            }
        } else {
            return nl2br($data->terms_en);
        }
    }
}
