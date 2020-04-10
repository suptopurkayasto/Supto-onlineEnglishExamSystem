<?php

namespace App\Model\Vocabulary\Definition;

use App\Exam;
use App\Set;
use Illuminate\Database\Eloquent\Model;

class DefinitionOption extends Model
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
    public function definition()
    {
        return $this->hasOne(Definition::class);
    }
}
