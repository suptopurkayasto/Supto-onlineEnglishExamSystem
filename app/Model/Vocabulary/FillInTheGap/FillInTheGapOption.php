<?php

namespace App\Model\Vocabulary\FillInTheGap;

use App\Exam;
use App\Set;
use Illuminate\Database\Eloquent\Model;

class FillInTheGapOption extends Model
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
    public function fillInTheGap()
    {
        return $this->hasOne(FillInTheGap::class);
    }
}
