<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public function users()
    {
        // to assign users to task: $task->users()->sync([6, 12, 15]);
        // to unassign users: $task->users->detach([6, 12, 15]);
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
