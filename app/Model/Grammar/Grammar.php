<?php

namespace App\Model\Grammar;

use App\Exam;
use App\Model\Grammar\Student\StudentGrammar;
use App\Set;
use Illuminate\Database\Eloquent\Model;

class Grammar extends Model
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

    // StudentGrammar
    public function studentGrammars()
    {
        return $this->hasMany(StudentGrammar::class);
    }
}
