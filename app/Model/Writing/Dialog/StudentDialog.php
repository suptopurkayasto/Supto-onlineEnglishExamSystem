<?php

namespace App\Model\Writing\Dialog;

use App\Exam;
use App\Student;
use Illuminate\Database\Eloquent\Model;

class StudentDialog extends Model
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
    public function dialog()
    {
        return $this->belongsTo(Dialog::class);
    }
}
