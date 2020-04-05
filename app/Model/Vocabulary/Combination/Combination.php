<?php

namespace App\Model\Vocabulary\Combination;

use App\Exam;
use App\QuestionSet;
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
        return $this->belongsTo(QuestionSet::class, 'question_set_id');
    }
    public function answer()
    {
        return $this->belongsTo(CombinationOption::class, 'combination_option_id');
    }
}
