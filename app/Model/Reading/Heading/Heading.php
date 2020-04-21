<?php

namespace App\Model\Reading\Heading;

use App\Exam;
use App\Model\Reading\Heading\Student\StudentHeading;
use App\Set;
use Illuminate\Database\Eloquent\Model;

class Heading extends Model
{
    protected $guarded = [];

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }
    public function set()
    {
        return $this->belongsTo(Set::class);
    }
    public function answer()
    {
        return $this->belongsTo(HeadingOption::class, 'heading_option_id');
    }
    // Heading
    public function studentHeadings()
    {
        return $this->hasMany(StudentHeading::class);
    }
}
