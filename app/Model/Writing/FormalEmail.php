<?php

namespace App\Model\Writing;

use App\Exam;
use App\QuestionSet;
use Illuminate\Database\Eloquent\Model;

class FormalEmail extends Model
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
}
