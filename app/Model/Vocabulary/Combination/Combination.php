<?php

namespace App\Model\Vocabulary\Combination;

use App\Exam;
use App\Model\Vocabulary\Combination\Student\StudentCombination;
use App\Set;
use Illuminate\Database\Eloquent\Model;

class Combination extends Model
{
    protected $guarded = [];

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }
    public function set()
    {
        return $this->belongsTo(Set::class);
    }
    public function answer()
    {
        return $this->belongsTo(CombinationOption::class, 'combination_option_id');
    }

    // Combination
    public function studentCombinations()
    {
        return $this->hasMany(StudentCombination::class);
    }
}
