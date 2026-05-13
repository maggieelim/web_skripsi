<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rubric extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'name',
        'weight',
        'parent_code'
    ];

    public function scores()
    {
        return $this->hasMany(RubricScore::class);
    }

    public function criteria()
    {
        return $this->hasMany(RubricCriteria::class);
    }
}
