<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beneficiary extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'name', 'responsible', 'identification', 'address', 'phone1', 'phone2', 'email', 'image', 'description', 'status', 'city_id'
    ];
}
