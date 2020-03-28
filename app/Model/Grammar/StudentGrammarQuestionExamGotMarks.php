<?php

namespace App\Model\Grammar;

use App\Exam;
use App\Student;
use Illuminate\Database\Eloquent\Model;

class StudentGrammarQuestionExamGotMarks extends Model
{
    protected $guarded = [];

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
