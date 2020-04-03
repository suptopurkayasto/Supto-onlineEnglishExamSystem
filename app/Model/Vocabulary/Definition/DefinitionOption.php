<?php

namespace App\Model\Vocabulary\Definition;

use App\Exam;
use App\QuestionSet;
use Illuminate\Database\Eloquent\Model;

class DefinitionOption extends Model
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
    public function definition()
    {
        return $this->hasOne(Definition::class);
    }
}
