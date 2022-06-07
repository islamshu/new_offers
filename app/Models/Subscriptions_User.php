<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscriptions_User extends Model
{
    use SoftDeletes,HasFactory;
    protected $table ='subscriptions_users';
    protected $guarded=[];
    /**
     * Get the user that owns the Subscriptions_User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function client()
    {
        return $this->belongsTo(Clinet::class,'clinet_id');
    }
    public function subscripe()
    {
        return $this->belongsTo(Subscription::class, 'sub_id');
    }
}
