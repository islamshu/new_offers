<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromocodeUser extends Model
{
    use HasFactory;
    /**
     * Get the user that owns the PromocodeUser
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function client()
    {
        return $this->belongsTo(Clinet::class, 'client_id');
    }
}
