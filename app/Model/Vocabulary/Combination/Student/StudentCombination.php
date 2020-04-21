<?php

namespace App\Model\Vocabulary\Combination\Student;

use App\Exam;
use App\Model\Vocabulary\Combination\Combination;
use App\Set;
use App\Student;
use Illuminate\Database\Eloquent\Model;

class StudentCombination extends Model
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
    public function combination()
    {
        return $this->belongsTo(Combination::class);
    }
}
