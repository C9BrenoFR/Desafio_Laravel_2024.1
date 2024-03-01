<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Pagination\Paginator;

class Doctor extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'doctors';

    protected $fillable = [
        'name',
        'email',
        'password',
        'bdate',
        'phone',
        'adress',
        'cpf',
        'pfp',
        'period',
        'crm',
        'specialty_id',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    public function specialty()
    {
        return $this->belongsTo(Specialty::class);
    }

    public function surgeries()
    {
        return $this->hasMany(Surgery::class);
    }
    
    public function findById($id)
    {
        return $this->where('id', $id)->first();
    }

    public function finfByName($name)
    {
        return $this->where('name', $name)->first();
    }
}
