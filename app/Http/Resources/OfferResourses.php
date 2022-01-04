<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OfferResourses extends JsonResource
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
       'image'=>asset('images/primary_offer/'.@$this->offerimage->primary_image),
       'type'=>$this->offer_type,
       'before_price'=>'',
       'price'=> 0,
       'percentage'=> null,
       'flash_deal'=> $this->is_flashdeal,
       'voucher'=> $this->is_voucher,
       'store_id'=> $this->vendor_id ,
       'store'=> new VendorResourses($this->vendor)  ,
        ];
    }
    public function lang_name($data)
    {
        $lang = request()->header('lang');
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
}
