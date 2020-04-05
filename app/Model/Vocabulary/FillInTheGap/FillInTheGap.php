<?php

namespace App\Model\Vocabulary\FillInTheGap;

use App\Exam;
use App\QuestionSet;
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
        return $this->belongsTo(QuestionSet::class, 'question_set_id');
    }
    public function answer()
    {
        return $this->belongsTo(FillInTheGapOption::class, 'fill_in_the_gap_option_id');
    }
}
