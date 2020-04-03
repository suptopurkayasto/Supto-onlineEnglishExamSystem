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
    public function sets()
    {
        return $this->belongsTo(QuestionSet::class, 'Question_set_id');
    }
    public function definition()
    {
        return $this->hasOne(Definition::class);
    }
}
