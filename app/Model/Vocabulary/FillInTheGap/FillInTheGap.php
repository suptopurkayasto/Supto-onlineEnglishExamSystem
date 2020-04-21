<?php

namespace App\Model\Vocabulary\FillInTheGap;

use App\Exam;
use App\Model\Vocabulary\FillInTheGap\Student\StudentFillInTheGap;
use App\Set;
use Illuminate\Database\Eloquent\Model;

class FillInTheGap extends Model
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
        return $this->belongsTo(FillInTheGapOption::class, 'fill_in_the_gap_option_id');
    }

    // Fill In The Gap
    public function studentFillInTheGaps()
    {
        return $this->hasMany(StudentFillInTheGap::class);
    }
}
