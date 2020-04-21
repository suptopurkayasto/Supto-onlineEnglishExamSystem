<?php

namespace App\Model\Reading\Heading\Student;

use App\Exam;
use App\Model\Reading\Heading\Heading;
use App\Model\Reading\Heading\HeadingOption;
use App\Set;
use App\Student;
use Illuminate\Database\Eloquent\Model;

class StudentHeading extends Model
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
    public function heading()
    {
        return $this->belongsTo(Heading::class);
    }
    public function headingOption()
    {
        return $this->belongsTo(HeadingOption::class);
    }
}
