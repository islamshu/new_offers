<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vendor extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];
    protected $table = "vendors";
 
    /**
     * Get the user that owns the Vendor
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->hasOne(User::class, 'vendor_id', 'id');
    }
    public function counteire()
    {
        return $this->belongsToMany(Country::class,'vendor_countries','vendor_id',  'country_id',);
    }
    /**
     * The roles that belong to the Vendor
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
   
    public function cities()
    {
        return $this->belongsToMany(City::class, 'vendor_cities','vendor_id', 'city_id');
    }
    public function currencies()
    {
        return $this->belongsToMany(Currency::class, 'currencies_vendors', 'vendor_id', 'currency_id');
    }
 
    public function categorys()
    {
        return $this->belongsToMany(Category::class, 'categories_vendors', 'vendor_id', 'category_id');
    }
    public function branches(){
        return $this->hasMany(Branch::class,'vendor_id');
    }
    public function vendor_image(){
        return $this->hasMany(ImageVendor::class,'vendor_id');
    }
    public function code_permfomed(){
        return $this->hasMany(CodePermfomed::class,'vendor_id');
    }
    public function offers(){
        return $this->hasMany(Offer::class,'vendor_id');
    }
    
    public function review()
    {
        return $this->hasMany(VendorReview::class, 'vendor_id');
    }


 
 
}
