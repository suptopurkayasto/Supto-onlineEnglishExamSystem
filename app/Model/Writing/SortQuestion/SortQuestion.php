<?php

namespace App\Model\Writing\SortQuestion;

use App\Exam;
use App\Set;
use Illuminate\Database\Eloquent\Model;

class SortQuestion extends Model
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

    // Sort Question
    public function studentSortQuestions()
    {
        return $this->hasMany(StudentSortQuestion::class);
    }

}
