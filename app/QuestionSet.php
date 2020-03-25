<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class QuestionSet extends Model
{
    protected $guarded = [];

    public function setNameAttribute($name)
    {
        return $this->attributes['name'] = Str::upper($name);
    }

    public function grammarQuestions()
    {
        return $this->hasMany(GrammarQuestion::class);
    }

    public function exams()
    {
        return $this->belongsToMany(Exam::class);
    }
}
