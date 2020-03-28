<?php

namespace App\Model\Writing;

use App\Exam;
use App\QuestionSet;
use App\Student;
use Illuminate\Database\Eloquent\Model;

class Dialog extends Model
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
    public function questionSet()
    {
        return $this->belongsTo(QuestionSet::class);
    }
}
