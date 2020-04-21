<?php

namespace App\Model\Vocabulary\Definition\Student;

use App\Exam;
use App\Model\Vocabulary\Definition\Definition;
use App\Set;
use App\Student;
use Illuminate\Database\Eloquent\Model;

class StudentDefinition extends Model
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
    public function definition()
    {
        return $this->belongsTo(Definition::class);
    }
}
