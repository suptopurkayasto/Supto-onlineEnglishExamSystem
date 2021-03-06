<?php

namespace App\Model\Reading\Rearrange;

use App\Exam;
use App\Set;
use Illuminate\Database\Eloquent\Model;

class Rearrange extends Model
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
}
