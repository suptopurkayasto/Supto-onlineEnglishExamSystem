<?php

namespace App\Model\Writing;

use Illuminate\Database\Eloquent\Model;

class WritingPart extends Model
{
    protected $guarded = [];

    public function dialogs()
    {
        return $this->hasMany(Dialog::class);
    }
}
