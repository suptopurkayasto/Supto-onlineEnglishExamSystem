<?php

namespace App;

use App\Model\Grammar\Grammar;
use App\Model\Grammar\Student\StudentGrammar;
use App\Model\Marks\Marks;
use App\Model\Reading\Heading\Heading;
use App\Model\Reading\Heading\HeadingOption;
use App\Model\Reading\Heading\Student\StudentHeading;
use App\Model\Reading\Rearrange\Rearrange;
use App\Model\Reading\Rearrange\Student\StudentRearrange;
use App\Model\Vocabulary\Combination\Combination;
use App\Model\Vocabulary\Combination\CombinationOption;
use App\Model\Vocabulary\Combination\Student\StudentCombination;
use App\Model\Vocabulary\Definition\Definition;
use App\Model\Vocabulary\Definition\DefinitionOption;
use App\Model\Vocabulary\Definition\Student\StudentDefinition;
use App\Model\Vocabulary\FillInTheGap\FillInTheGap;
use App\Model\Vocabulary\FillInTheGap\FillInTheGapOption;
use App\Model\Vocabulary\FillInTheGap\Student\StudentFillInTheGap;
use App\Model\Vocabulary\Synonym\Student\StudentSynonym;
use App\Model\Vocabulary\Synonym\Synonym;
use App\Model\Vocabulary\Synonym\SynonymOption;
use App\Model\Writing\Dialog\Dialog;
use App\Model\Writing\Dialog\StudentDialog;
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

//    public function setNameAttribute($name)
//    {
//        return $this->attributes['name'] = '('.$name.')-'.Auth::guard('teacher')->user()->location->name;
//    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function grammars()
    {
        return $this->hasMany(Grammar::class);
    }

    public function sets()
    {
        return $this->belongsToMany(Set::class);
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

    // Fill In The Gap
    public function fillInTheGaps()
    {
        return $this->hasMany(FillInTheGap::class);
    }
    // Fill In The Gap Options
    public function fillInTheGapOptions()
    {
        return $this->hasMany(FillInTheGapOption::class);
    }

    /**
     * Method for Reading part
     */
    // Rearrange
    public function rearranges()
    {
        return $this->hasMany(Rearrange::class);
    }

    // Heading
    public function headings()
    {
        return $this->hasMany(Heading::class);
    }
    // Heading Option
    public function headingOptions()
    {
        return $this->hasMany(HeadingOption::class);
    }


    // StudentGrammar
    public function studentGrammars()
    {
        return $this->hasMany(StudentGrammar::class);
    }

    // Marks
    public function marks()
    {
        return $this->hasMany(Marks::class);
    }


    /**
     * Student Vocabulary
     */
    // Synonym
    public function studentSynonyms()
    {
        return $this->hasMany(StudentSynonym::class);
    }

    // Definition
    public function studentDefinitions()
    {
        return $this->hasMany(StudentDefinition::class);
    }

    // Combination
    public function studentCombinations()
    {
        return $this->hasMany(StudentCombination::class);
    }

    // Fill In The Gap
    public function studentFillInTheGaps()
    {
        return $this->hasMany(StudentFillInTheGap::class);
    }


    /**
     * Student Reading
     */
    // Rearrange
    public function studentRearranges()
    {
        return $this->hasMany(StudentRearrange::class);
    }
    // Heading
    public function studentHeadings()
    {
        return $this->hasMany(StudentHeading::class);
    }

    /**
     * Student Writing
     */
    // Dialog
    public function studentDialogs()
    {
        return $this->hasOne(StudentDialog::class);
    }

}
