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
        'image_ci2',
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
        'deleted_at',

        'spanish',
        'english',
        'frances',
        'italiano',
        'portugues',
        'aleman',
        'otro_idioma',

        'exp_mant_piscina',
        'trabajado_ante_donde',
        'medir_ph',
        'asp_piscina',
        'cant_quimico',
        'bomba_agua',

        'image_book',
        'curso_modelaje',
        'exp_modelaje',
        'talla_sup',
        'talla_inf',
        'nro_calzado'
    ];
    
}
