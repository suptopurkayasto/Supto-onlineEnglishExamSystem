<?php

namespace App\Model\Reading\Heading;

use Illuminate\Database\Eloquent\Model;

class HeadingOption extends Model
{
    protected $guarded = [];

    // Heading
    public function heading()
    {
        return $this->hasOne(Heading::class);
    }
}
