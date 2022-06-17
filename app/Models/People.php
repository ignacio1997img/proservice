<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    use HasFactory;

    protected $fillable = [
        'ci', 'first_name', 'last_name','birth_date', 'email', 'phone1', 'phone2', 'address', 'city', 'sex', 'weight', 'height',
        'image', 'user_id', 'status', 'city_id'
    ];
}
