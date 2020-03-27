<?php

namespace App\GrammarQuestion;

use App\QuestionSet;
use App\Student;
use Illuminate\Database\Eloquent\Model;

class StudentGrammarQuestion extends Model
{
    protected $guarded = [];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    public function question_set()
    {
        return $this->belongsTo(QuestionSet::class);
    }
}
