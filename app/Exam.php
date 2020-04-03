<?php

namespace App;

use App\Model\Grammar\Grammar;
use App\Model\Grammar\StudentGrammarQuestion;
use App\Model\Vocabulary\Combination\Combination;
use App\Model\Vocabulary\Combination\CombinationOption;
use App\Model\Vocabulary\Definition\Definition;
use App\Model\Vocabulary\Definition\DefinitionOption;
use App\Model\Vocabulary\Synonym\Synonym;
use App\Model\Vocabulary\Synonym\SynonymOption;
use App\Model\Writing\Dialog;
use App\Model\Writing\FormalEmail;
use App\Model\Writing\InformalEmail;
use App\Model\Writing\SortQuestion;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Exam extends Model
{
    protected $fillable = [
        'name', 'slug', 'user_id', 'status'
    ];

    public function setNameAttribute($name)
    {
        return $this->attributes['name'] = '('.$name.')-'.Auth::guard('teacher')->user()->location->name;
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function grammarQuestions()
    {
        return $this->hasMany(Grammar::class);
    }

    public function sets()
    {
        return $this->belongsToMany(QuestionSet::class, 'exam_question_set', 'exam_id');
    }
    public function students()
    {
        return $this->hasMany(StudentGrammarQuestion::class);
    }

    // Dialog
    public function dialogs()
    {
        return $this->hasMany(Dialog::class);
    }
    // Informal Email
    public function informalEmails()
    {
        return $this->hasMany(InformalEmail::class);
    }
    // Formal Email
    public function formalEmails()
    {
        return $this->hasMany(FormalEmail::class);
    }
    // Sort Questions
    public function sortQuestions()
    {
        return $this->hasMany(SortQuestion::class);
    }

    // Synonym
    public function synonyms()
    {
        return $this->hasMany(Synonym::class);
    }

    // Synonym Options
    public function synonymOptions()
    {
        return $this->hasMany(SynonymOption::class);
    }

    // Definition
    public function definitions()
    {
        return $this->hasMany(Definition::class);
    }
    // DefinitionOptions
    public function definitionOptions()
    {
        return $this->hasMany(DefinitionOption::class);
    }
    // Combination
    public function combinations()
    {
        return $this->hasMany(Combination::class);
    }
    // Combination Options
    public function combinationOptions()
    {
        return $this->hasMany(CombinationOption::class);
    }


}
