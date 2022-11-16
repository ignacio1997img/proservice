<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusineRequirement extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'image_nit',
        'busine_id',
        'image_lf',
        'image_roe',
        'image_pd',
        'exp_modelo',
        'status',
        'deleted_at'
    ];


}
