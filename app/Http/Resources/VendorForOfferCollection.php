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
        $collction = VendorForOfferResourses::collection($this->collection);
        $datad = [];
        foreach (collect($collction)->sortBy('distance') as $data) {
          array_push($datad, $data);
        }
        $sliders = Slider::where('categoty_id',$request->category_id)->where('country_id',$request->country_id)->where('city_id',$request->city_id)->get();
        return [
            'stores' =>paginate($this->collection,10),
            'category_slider_images' => new SliderCollection($sliders),
        ];
    }
}
