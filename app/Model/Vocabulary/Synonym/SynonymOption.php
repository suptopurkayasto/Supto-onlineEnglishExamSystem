<?php

namespace App\Model\Vocabulary\Synonym;

use App\Exam;
use App\QuestionSet;
use Illuminate\Database\Eloquent\Model;

class SynonymOption extends Model
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
    public function synonym()
    {
        return $this->hasOne(Synonym::class);
    }
}
