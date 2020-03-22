<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $guarded = [];


    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
