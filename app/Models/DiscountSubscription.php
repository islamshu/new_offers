<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountSubscription extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function discount()
    {
        return $this->belongsTo(Discount::class, 'client_id');
    }
}
