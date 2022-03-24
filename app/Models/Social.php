<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    use HasFactory;
    protected $fillable = [
        'key', 'value',
    ];
    public $timestamps = false;


   
    public static function setValue($key, $value)
    {
        static::query()->updateOrCreate([
            'key' => $key,
        ], [
            'value' => $value,
        ]);
    }
}
