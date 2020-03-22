<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends Model
{

    use SoftDeletes;
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
