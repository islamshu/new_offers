<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VendorReviewResourses extends JsonResource
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
            'stars_no'=>$this->rate,
            'comment'=>$this->comment,
            'created_at'=>$this->created_at,
            'client'=>$this->client_info($this),
            'store_review_images'=>$this->store_review_images($this),
        ];
    }
    public function client_info($data)
    {
        return[
            'name'=>@$this->user->name,
            'image'=>asset('images/'.@$this->user->image),
        ];
    }
    public function store_review_images($data)
    {
        return[
            'id'=>@$this->id,
            'image'=>asset('images/review'.@$this->image),
        ];
    }
}
