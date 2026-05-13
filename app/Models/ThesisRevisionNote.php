<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThesisRevisionNote extends Model
{
    use HasFactory;
    protected $fillable = [
        'thesis_id',
        'lecturer_id',
        'substance_note',
        'methodology_note',
        'writing_note',
        'is_submitted'
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
