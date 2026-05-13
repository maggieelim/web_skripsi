<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RubricScore extends Model
{
    use HasFactory;
    protected $fillable = [
        'thesis_id',
        'lecturer_id',
        'rubric_id',
        'score'
    ];

    public function thesis()
    {
        return $this->belongsTo(Thesis::class);
    }

    public function lecturer()
    {
        return $this->belongsTo(Lecturer::class);
    }

    public function rubric()
    {
        return $this->belongsTo(Rubric::class);
    }
}
