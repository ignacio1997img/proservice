<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusineRequirement extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'busine_id',
        'image_lf',
        'image_roe',
        'image_pd',
        'status',
        'deleted_at'
    ];


}
