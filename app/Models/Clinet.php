<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;
use Illuminate\Database\Eloquent\SoftDeletes; 
use Laravel\Passport\HasApiTokens;


class Clinet extends Authenticatable
{
    use LaratrustUserTrait, Notifiable,SoftDeletes , HasApiTokens;
    /**
     * Get the user that owns the Clinet
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    protected $guarded=[];
    public function city()
    {
        return $this->belongsTo(City::class);
    }
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
    /**
     * Get the user that owns the Clinet
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subs()
    {
        return $this->hasMany(Subscriptions_User::class);
    }
    public function subsTranshed()
    {
        return $this->hasMany(Subscriptions_User::class)->withTrashed();
    }
    public function subs_last()
    {
        return $this->hasMany(Subscriptions_User::class)->latest();

    }
    public function trans()
    {
        return $this->hasMany(Transaction::class,'client_id');
    }

    
}
