<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;
    protected $guarded =[];
    
    public function package()
    {
        return $this->belongsTo(Subscription::class, 'sub_id');
    }
    public function promocode()
    {
        return $this->hasOne(DiscountSubscription::class, 'discount_id');
    }

    
}
