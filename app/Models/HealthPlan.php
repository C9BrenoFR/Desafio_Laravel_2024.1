<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;

class HealthPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'desc',
        'discount',
    ];

    public function users($id)
    {
        $users = User::where('healthp_id', $id)->get();
        return $users;
    }

    public function findById($id)
    {
        return $this->where('id', $id)->first();
    }
}
