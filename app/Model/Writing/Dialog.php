<?php

namespace App\Model\Writing;

use App\Exam;
use App\Set;
use App\Student;
use Illuminate\Database\Eloquent\Model;

class Dialog extends Model
{
    protected $guarded = [];

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }
    public function set()
    {
        return $this->belongsTo(Set::class, 'question_set_id');
    }

    public function writingPart()
    {
        return $this->belongsTo(WritingPart::class);
    }
}
