<?php

namespace App\Model\Reading\Heading;

use App\Exam;
use App\QuestionSet;
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
        return $this->belongsTo(QuestionSet::class, 'question_set_id');
    }

    // Heading
    public function heading()
    {
        return $this->hasOne(Heading::class);
    }
}
