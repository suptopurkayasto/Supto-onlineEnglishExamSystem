<?php

namespace App\Model\Writing\SortQuestion;

use App\Exam;
use App\Student;
use Illuminate\Database\Eloquent\Model;

class StudentSortQuestion extends Model
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
    public function sortQuestion()
    {
        return $this->belongsTo(SortQuestion::class);
    }
}
