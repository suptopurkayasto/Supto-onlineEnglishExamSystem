<?php

namespace App\Model\Marks;

use App\Exam;
use App\Set;
use App\Student;
use Illuminate\Database\Eloquent\Model;

class Marks extends Model
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
