<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessagePeople extends Model
{
    use HasFactory;

    protected $fillable = [
        'people_id', 'rubro_people_id', 'busine_id', 'rubro_busine_id', 'detail', 'view', 'status'
    ];

    public function busine()
    {
        return $this->belongsTo(Busine::class, 'busine_id');
    }

    public function rubro_busine()
    {
        return $this->belongsTo(RubroBusine::class, 'rubro_busine_id');
    }
}