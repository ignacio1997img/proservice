<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Busine extends Model
{
    use HasFactory;

    protected $fillable = [
        'nit', 'name', 'responsible', 'address', 'phone1', 'phone2', 'email', 'image', 'user_id', 'rubro_id', 'description', 'status', 'deleted_at', 'website'
    ];

    public function rubrobusines()
    {
        return $this->belongsTo(RubroBusine::class, 'rubro_id');
    }

}
