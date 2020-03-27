<?php

namespace App;

use App\Model\Grammar\GrammarQuestion;
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
        return $this->belongsToMany(Exam::class, 'exam_question_set', 'question_set_id');
    }
    public function students()
    {
        return $this->belongsToMany(Student::class);
    }
}
