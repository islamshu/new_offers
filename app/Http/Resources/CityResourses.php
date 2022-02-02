<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CityResourses extends JsonResource
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
            'name'=> $this->lang_name($this),
        ];
    }
    public function lang_name($data){
        $lang = request()->header('Lang');
        dd($data->city_name);
        if($lang != null){
            if($lang  =='ar'){
                return $data->city_name;
            }else{
                return $data->city_name_english;
  
            }
        }else{
            return $data->city_name_english;

        }
    }
}
