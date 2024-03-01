<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;

class Specialty extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'desc',
        'price',
    ];

    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }

    public function findById($id)
    {
        return $this->where('id', $id)->first();
    }  
}
