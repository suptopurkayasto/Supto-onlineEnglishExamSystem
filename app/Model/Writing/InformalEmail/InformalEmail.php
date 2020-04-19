<?php

namespace App\Model\Writing\InformalEmail;

use App\Exam;
use App\Set;
use Illuminate\Database\Eloquent\Model;

class InformalEmail extends Model
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

    // Informal Email
    public function studentInformalEmail()
    {
        return $this->hasMany(StudentInformalEmail::class);
    }
}
