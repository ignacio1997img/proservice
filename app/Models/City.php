<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'department_id', 'detail', 'status', 'deleted_at'];

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

}
