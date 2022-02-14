<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class VendorOfferCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $Col = VendorOfferResourses::collection($this->collection);
        $datad = [];
        foreach (collect($Col)->sortBy('distance') as $data) {
          array_push($datad, $data);
        }
        return[
            'offers' =>$datad,
            'category_slider_images'=>[],
        ];
    }
}
