<?php

namespace App;

use App\Model\Grammar\Student\StudentGrammar;
use App\Model\Marks\Marks;
use App\Model\Reading\Heading\Student\StudentHeading;
use App\Model\Reading\Rearrange\Student\StudentRearrange;
use App\Model\Vocabulary\Combination\Student\StudentCombination;
use App\Model\Vocabulary\Definition\Student\StudentDefinition;
use App\Model\Vocabulary\FillInTheGap\Student\StudentFillInTheGap;
use App\Model\Vocabulary\Synonym\Student\StudentSynonym;
use App\Model\Writing\Dialog;
use App\Model\Writing\Dialog\StudentDialog;
use App\Model\Writing\FormalEmail\StudentFormalEmail;
use App\Model\Writing\InformalEmail\StudentInformalEmail;
use App\Model\Writing\SortQuestion\StudentSortQuestion;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class Student extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'teacher_id', 'group_id', 'section_id', 'location_id', 'set_id', 'phone_number'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
    public function section()
    {
        return $this->belongsTo(Section::class);
    }
    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
    public function set()
    {
        return $this->belongsTo(Set::class);
    }


    // StudentGrammar
    public function studentGrammars()
    {
        return $this->hasMany(StudentGrammar::class);
    }

    // Marks
    public function marks()
    {
        return $this->hasOne(Marks::class);
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
        return $this->hasMany(StudentDialog::class);
    }
    // Informal Email
    public function studentInformalEmails()
    {
        return $this->hasMany(StudentInformalEmail::class);
    }
    // Formal Email
    public function studentFormalEmails()
    {
        return $this->hasMany(StudentFormalEmail::class);
    }
    // Sort Question
    public function studentSortQuestions()
    {
        return $this->hasMany(StudentSortQuestion::class);
    }


}
