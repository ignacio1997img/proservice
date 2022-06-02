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
        'date_view',
        'status',
        'deleted_at',

        'star', 'comment', 'star_date'
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


