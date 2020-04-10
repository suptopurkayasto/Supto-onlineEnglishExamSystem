<?php

namespace App\Model\Vocabulary\Definition;

use App\Exam;
use App\Set;
use Illuminate\Database\Eloquent\Model;

class Definition extends Model
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
        return $this->belongsTo(DefinitionOption::class, 'definition_option_id');
    }
}
