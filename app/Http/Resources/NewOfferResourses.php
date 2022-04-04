<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NewOfferResourses extends JsonResource
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
            'details'=>$this->lang_dec($this),
            'price'=>@$this->offertype->price,
            'before_price'=>@$this->offertype->price_befor_discount,
            'percentage'=>@$this->offertype->discount_value,
            'estimated_saving'=>offer_saving( (int)$this->id),
            'expire_date'=>$this->end_time,
            'type'=>@$this->offer_type,
            'image'=>asset('images/brand/'.@$this->image),
            'membership_type'=>@$this->member_type,
        ];
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
    public function lang_dec($data)
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
}
