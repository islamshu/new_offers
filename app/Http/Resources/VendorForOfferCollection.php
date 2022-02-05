<?php

namespace App\Http\Resources;

use App\Models\Slider;
use Illuminate\Http\Resources\Json\ResourceCollection;

class VendorForOfferCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $sliders = Slider::where('categoty_id',$request->category_id)->where('country_id',$request->country_id)->where('city_id',$request->city_id)->get();
        return [
            'count' => $this->count(),
            'total' => $this->total(),
            'prev'  => $this->appends(request()->input())->previousPageUrl(), 
            'next'  => $this->appends($request)->nextPageUrl(),  
            'stores' =>VendorForOfferResourses::collection($this->collection),
            'category_slider_images' => new SliderCollection($sliders),
        ];
    }
}
