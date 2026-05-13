<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupervisorScore extends Model
{
    use HasFactory;
    protected $fillable = [
        'thesis_id',
        'lecturer_id',
        'score',
        'notes'
    ];

    public function thesis()
    {
        return $this->belongsTo(Thesis::class);
    }

    public function lecturer()
    {
        return $this->belongsTo(Lecturer::class);
    }
}
