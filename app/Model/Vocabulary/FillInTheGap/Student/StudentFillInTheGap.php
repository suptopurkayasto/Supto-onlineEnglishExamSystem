<?php

namespace App\Model\Vocabulary\FillInTheGap\Student;

use App\Exam;
use App\Model\Vocabulary\FillInTheGap\FillInTheGap;
use App\Set;
use App\Student;
use Illuminate\Database\Eloquent\Model;

class StudentFillInTheGap extends Model
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
        return $this->belongsTo(Set::class);
    }
    public function fillInTheGap()
    {
        return $this->belongsTo(FillInTheGap::class);
    }
}
