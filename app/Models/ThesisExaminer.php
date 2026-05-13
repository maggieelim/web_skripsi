<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThesisExaminer extends Model
{
    use HasFactory;
    protected $fillable = [
        'thesis_id',
        'lecturer_id',
        'role'
    ];

    public function thesis()
    {
        return $this->belongsTo(Thesis::class);
    }

    public function lecturer()
    {
        return $this->belongsTo(Lecturer::class);
    }

    public function revisionNotes()
    {
        return $this->hasMany(ThesisRevisionNote::class, 'thesis_examiner_id');
    }
}
