<?php

namespace App\Model\Vocabulary\Synonym;

use App\Exam;
use App\Model\Vocabulary\Synonym\Student\StudentSynonym;
use App\Set;
use Illuminate\Database\Eloquent\Model;

class Synonym extends Model
{
    protected $guarded = [];

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }
    public function set()
    {
        return $this->belongsTo(Set::class);
    }
    public function answer()
    {
        return $this->belongsTo(SynonymOption::class, 'synonym_option_id');
    }

    /**
     * Student Vocabulary
     */
    // Synonym
    public function studentSynonyms()
    {
        return $this->hasOne(StudentSynonym::class);
    }
}
