<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeopleRequirement extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'people_experience_id',
        'image_ci',
        'image_ap',
        'image_lsm',
        'image_fcc',
        't_manana',
        't_tarde',
        't_dia',
        't_noche',
        'exp_jardineria',
        'exp_paisajismo',
        'exp_maquinas',
        'estatura',
        'peso',
        'status',
    ];
    
}
