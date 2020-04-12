<?php

namespace App;

use App\Model\Grammar\Student\StudentGrammar;
use App\Model\Marks\Marks;
use App\Model\Vocabulary\Combination\Student\StudentCombination;
use App\Model\Vocabulary\Definition\Student\StudentDefinition;
use App\Model\Vocabulary\FillInTheGap\Student\StudentFillInTheGap;
use App\Model\Vocabulary\Synonym\Student\StudentSynonym;
use App\Model\Writing\Dialog;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class Student extends Authenticatable
{
    use SoftDeletes;
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

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
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


}
