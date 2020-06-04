<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    protected $fillable = [
        'name',
    ];

    public function task()
    {
        return $this->belongsTo('App\Task');
    }
}
