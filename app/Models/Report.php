<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'time',
        'title',
        'description',
        'reporter_id',
        'status',
        'resolution',
    ];

    protected $casts = [
        'date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function reporter()
    {
        return $this->belongsTo(User::class, 'reporter_id');
    }
}