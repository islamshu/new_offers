<?php

namespace App\Http\Resources;
use App\Models\HomesliderOffer;
use App\Models\Offer;
use Illuminate\Http\Resources\Json\JsonResource;

class HomeSLiderResourses extends JsonResource
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
            'color'=>$this->color,
            'offers'=>$this->get_offer($this),
        ];
    }
    public function get_offer($data){
        $slider =HomesliderOffer::where('homeslider_id',$this->id)->get();
        $array =[];
        foreach($slider as $of){
            array_push($array,$of->offer_id);
        }
    
        
        return new OfferCollection(Offer::whereIn('id',$array)->get());
        
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
