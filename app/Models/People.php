<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class People extends Model
{
    use HasFactory;

    protected $fillable = [
        'ci', 'first_name', 'last_name','birth_date', 'email', 'phone1', 'phone2', 'address', 'city', 'sex', 'weight', 'height',
        'image', 'user_id', 'status', 'city_id', 'facebook', 'instagram', 'tiktok'
    ];

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }
}
