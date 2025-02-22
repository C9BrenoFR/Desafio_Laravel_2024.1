<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;

class Surgery extends Model
{

    use HasFactory;

    protected $fillable = [
        'type',
        'date_start',
        'date_end',
        'price',
        'doctor_id',
        'patient_id',
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function patient()
    {
        return $this->belongsTo(User::class);
    }

    public function findById($id)
    {
        return $this->where('id', $id)->first();
    }
}
