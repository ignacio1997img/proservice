<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'pasantia_id', 'name', 'institution', 'start', 'finish', 'status', 'deleted_at'
    ];
}
