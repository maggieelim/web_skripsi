<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RubricCriteria extends Model
{
    use HasFactory;

    protected $fillable = [
        'rubric_id',
        'score_level',
        'description'
    ];

    public function rubric()
    {
        return $this->belongsTo(Rubric::class);
    }
}
