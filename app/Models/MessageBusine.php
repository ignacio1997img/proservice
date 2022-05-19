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
        'delete_at',
    ];
}


