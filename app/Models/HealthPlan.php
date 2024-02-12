<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HealthPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'desc',
        'discount',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
