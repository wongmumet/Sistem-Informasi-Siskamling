<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resident extends Model
{
    use HasFactory;

    protected $fillable = [
        'nik',
        'name',
        'address',
        'phone',
        'gender',
        'birth_date',
    ];

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}