<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    
    public function country(){
        return $this->belongsTo(country::class);
    }
    public function enterprise_city(){
        return $this->hasMany(enterprise_city::class,'city_id');
    }
}
