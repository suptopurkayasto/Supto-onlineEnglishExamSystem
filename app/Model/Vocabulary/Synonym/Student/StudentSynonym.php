<?php

namespace App\Model\Vocabulary\Synonym\Student;

use App\Exam;
use App\Model\Vocabulary\Synonym\Synonym;
use App\QuestionSet;
use App\Student;
use Illuminate\Database\Eloquent\Model;

class StudentSynonym extends Model
{
    protected $guarded = [];

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
        return $this->belongsTo(QuestionSet::class);
    }
    public function synonym()
    {
        return $this->belongsTo(Synonym::class);
    }
}
