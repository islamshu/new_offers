<?php

namespace App\Http\Resources;

use App\Models\Vendor;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewnewResourses extends JsonResource
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
            'id'=>$this->id,
            'stars_no'=>$this->rate,
            'comment'=>$this->comment,
            'created_at'=>$this->created_at,
            'store_id'=>$this->vendor_id,
            'store'=>new VendorForOfferResourses(Vendor::find($this->vendor_id)),
            'store_review_images'=>$this->store_review_images($this),
        ];
    }
    public function store_review_images($data)
    {
        if($data->images != null){
            $image = $data->images;
            $array = [];
            
            foreach($image as $im){
              $data =  [
                    'id'=>$data->id,
                    'store_review_id'=>$data->store_id,
                    'image'=>asset('vendor_review'.@$im)
                ];
                array_push($array,$data);
            }
            return $array;
        }else{
            return [];
        }
        
    }
}
