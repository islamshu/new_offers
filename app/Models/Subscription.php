<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Subscription extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded =[];
    public function subs()
    {
        return $this->belongsToMany(Subscriptions_User::class,'subscriptions_users','sub_id','user_id');
    }
}
