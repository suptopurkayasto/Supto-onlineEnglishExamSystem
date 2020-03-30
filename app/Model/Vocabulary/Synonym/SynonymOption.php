<?php

namespace App\Model\Vocabulary\Synonym;

use Illuminate\Database\Eloquent\Model;

class SynonymOption extends Model
{
    protected $guarded = [];

    public function synonym()
    {
        return $this->belongsTo(Synonym::class);
    }
}
