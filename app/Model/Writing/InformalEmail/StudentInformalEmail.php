<?php

namespace App\Model\Writing\InformalEmail;

use App\Exam;
use App\Student;
use Illuminate\Database\Eloquent\Model;

class StudentInformalEmail extends Model
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
    public function informalEmail()
    {
        return $this->belongsTo(InformalEmail::class);
    }
}
