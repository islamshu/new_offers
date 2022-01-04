<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BranchResourses extends JsonResource
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
            'id' => $this->id,
            'name' => $this->get_lang($this),
            'phone' => $this->phone,
            'distance' => @$this->get_dinstance($this, $request),
            'address' => $this->address($this),
            'lang_lat'=>$this->lang_lat($this)
        ];
    }
    public function lang_lat($data)
    {
       return[
           'latitude'=>$data->latitude,
           'longitude'=>$data->longitude,
       ];
    }
    public function address($data)
    {
        $lang = request()->header('lang');
        if ($lang != null) {
            if ($lang  == 'en') {
                return [
                    'country' => @$this->city->country->country_name_en,
                    'city' => @$this->city->city_name_english,
                    'neighborhood' => @$this->neighborhood->neighborhood_name_english,
                ];
            } else {
                return [
                    'country' => @$this->city->country->country_name_ar,
                    'city' => @$this->city->city_name,
                    'neighborhood' => @$this->neighborhood->neighborhood_name,
                ];
            }
        } else {
            return [
                'country' => @$this->city->country->country_name_en,
                'city' => @$this->city->city_name_english,
                'neighborhood' => @$this->neighborhood->neighborhood_name_english,
            ];
        }
    }
    public function get_dinstance($data, $request)
    {


        $value =  get_dinstance($request->latitude, $request->longitude, $data->latitude, $data->longitude);
        $di = $value  * 1.609344;
        return $di;
    }
    public function get_lang($data)
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
