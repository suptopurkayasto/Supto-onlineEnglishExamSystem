<?php

namespace App\Model\Writing\FormalEmail;

use App\Exam;
use App\Set;
use Illuminate\Database\Eloquent\Model;

class FormalEmail extends Model
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
    // Formal Email
    public function studentFormalEmails()
    {
        return $this->hasMany(StudentFormalEmail::class);
    }
}
