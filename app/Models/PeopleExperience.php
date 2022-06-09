<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeopleExperience extends Model
{
    use HasFactory;

    protected $fillable = [
        'people_id',
        'rubro_id',
        'status',
        'deleted_at',
        'cant', 'star'
    ];

    public function rubro_people()
    {
        return $this->belongsTo(RubroPeople::class, 'rubro_id');
    }

}