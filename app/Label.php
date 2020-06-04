<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    protected $fillable = [
        'name',
    ];

    public function tasks()
    {
        return $this->belongsToMany('App\Task', 'task_label');
    }
}
