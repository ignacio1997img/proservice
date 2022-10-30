<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modelfolio extends Model
{
    use HasFactory;

    protected $fillable = ['peopleExperiences_id', 'status', 'deleted_at'];
}
