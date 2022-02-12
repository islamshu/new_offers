<?php

namespace App\Http\Resources;

use App\Models\Subscription;
use Illuminate\Http\Resources\Json\JsonResource;

class UserSubscription extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $client = auth('client_api')->user();
        return [
            'start_date'=>$client->start_date,
            'expire_date'=>$client->expire_date,
            'offers_saving'=>$client->offers_saving,
            'coupons_saving'=>$client->coupon_saving,
            'coupons_no'=> $client->balance,
            'used_offers_no'=>$client->used_offers_no,
            'purchases_no'=>$client->purchases_no,
            'points_no'=>$client->points_no,
            'store_points_no'=>$client->store_points_no,
            'package_id'=>$this->sub_id,
            'duration_id'=>$this->id,
            'actual_account_no'=>$client->actual_accounts_no,
            'price'=>$this->balnce,
            'package'=>new PakegeResourses(Subscription::find($this->sub_id))





        ];
    }
}
