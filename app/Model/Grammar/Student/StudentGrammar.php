<?php

namespace App\Model\Grammar\Student;

use App\Exam;
use App\Model\Grammar\Grammar;
use App\QuestionSet;
use App\Student;
use Illuminate\Database\Eloquent\Model;

class StudentGrammar extends Model
{
    protected $guarded = [];

    public function grammar()
    {
        return $this->belongsTo(Grammar::class);
    }
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function set()
    {
        return $this->belongsTo(QuestionSet::class, 'question_set_id');
    }
}
