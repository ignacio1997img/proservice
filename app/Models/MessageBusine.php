<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageBusine extends Model
{
    use HasFactory;
    protected $fillable = [
        'busine_id',
        'rubro_busine_id',
        'beneficiary_id',
        'detail',
        'view',
        'status',
        'deleted_at',
    ];

    public function busine()
    {
        return $this->belongsTo(Busine::class, 'busine_id');
    }

    public function rubro_busine()
    {
        return $this->belongsTo(RubroBusine::class, 'rubro_busine_id');
    }

    public function beneficiary()
    {
        return $this->belongsTo(Beneficiary::class, 'beneficiary_id');
    }
}


