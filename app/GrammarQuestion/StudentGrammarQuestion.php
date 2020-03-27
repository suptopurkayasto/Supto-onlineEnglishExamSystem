<?php

namespace App\GrammarQuestion;

use App\Exam;
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
    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }
}
