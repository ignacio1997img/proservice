<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RubroBusine extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name', 'description', 'image', 'status'
    ];

    public function Busines()
    {
        return $this->hasMany(Busine::class);
    }
}
