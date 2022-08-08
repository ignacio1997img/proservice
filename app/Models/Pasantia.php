<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasantia extends Model
{
    use HasFactory;
    protected $fillable = [
        'profession_id', 'people_id', 'type', 'semester', 'institution', 'objetive', 'status', 'deleted_at'
    ];
}
