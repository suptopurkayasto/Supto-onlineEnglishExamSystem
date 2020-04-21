<?php

namespace App\Model\Reading\Rearrange\Student;

use App\Exam;
use App\Set;
use App\Student;
use Illuminate\Database\Eloquent\Model;

class StudentRearrange extends Model
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
}
