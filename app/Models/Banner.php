<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;
    protected $guarded=[];
    /**
     * Get the user that owns the Banner
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function homeslider()
    {
        return $this->belongsTo(Homeslider::class, 'homeslider_id');
    }
}
