<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferUser extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function offer()
    {
        return $this->belongsTo(Offer::class, 'offer_id')->withTrashed();;
    }
    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id')->withTrashed();;
    }
    public function branch ()
    {
        return $this->belongsTo(Branch::class, 'branch_id')->withTrashed();;
    }

    

}
