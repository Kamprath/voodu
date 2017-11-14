<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function tasks()
    {
        // to assign tasks to user: $user->tasks()->sync([6, 12, 15]);
        // to unassign tasks: $user->tasks->detach([6, 12, 15]);
        return $this->belongsToMany(Task::class)->withTimestamps();
    }
}
