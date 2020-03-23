<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $fillable = [
        'name', 'slug', 'user_id', 'admin_id'
    ];
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
