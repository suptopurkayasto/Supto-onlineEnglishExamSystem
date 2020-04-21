<?php

namespace App\Model\Writing\FormalEmail;

use App\Exam;
use App\Student;
use Illuminate\Database\Eloquent\Model;

class StudentFormalEmail extends Model
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
    public function formalEmail()
    {
        return $this->belongsTo(formalEmail::class);
    }
}
