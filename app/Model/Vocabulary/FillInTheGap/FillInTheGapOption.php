<?php

namespace App\Model\Vocabulary\FillInTheGap;

use Illuminate\Database\Eloquent\Model;

class FillInTheGapOption extends Model
{
    protected $guarded = [];

    public function fillInTheGap()
    {
        return $this->hasOne(FillInTheGap::class);
    }
}
