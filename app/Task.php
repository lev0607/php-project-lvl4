<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'name', 'description', 'status_id', 'created_by_id', 'assigned_to_id',
    ];
    public function user()
    {
        return $this->belongsTo('App\User', 'created_by_id');
    }

    public function status()
    {
        return $this->belongsTo('App\TaskStatus');
    }

    public function labels()
    {
        return $this->belongsToMany('App\Label', 'task_label');
    }
}
