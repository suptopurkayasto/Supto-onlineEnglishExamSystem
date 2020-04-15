<?php

namespace App\Model\Reading\Heading;

use App\Exam;
use App\Model\Reading\Heading\Student\StudentHeading;
use App\Set;
use Illuminate\Database\Eloquent\Model;

class HeadingOption extends Model
{
    protected $guarded = [];


    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }
    public function set()
    {
        return $this->belongsTo(Set::class, 'set_id');
    }

    // Heading
    public function heading()
    {
        return $this->hasOne(Heading::class);
    }

    // Student Heading
    public function studentHeadings()
    {
        return $this->hasMany(StudentHeading::class);
    }
}
