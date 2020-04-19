<?php

namespace App\Model\Writing\Dialog;

use App\Exam;
use App\Set;
use Illuminate\Database\Eloquent\Model;

class Dialog extends Model
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

    /**
     * Student Writing
     */
    // Dialog
    public function studentDialogs()
    {
        return $this->hasOne(StudentDialog::class);
    }
}
