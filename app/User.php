<?php

namespace App;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

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

    /**
     * Determine if user has access to a board.
     *
     * @param int $id   Board ID
     * @return bool
     */
    public function hasBoard($id) : bool
    {
        try {
            $board = Board::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return false;
        }

        return $board->is_public || $board->created_by === $this->id;
    }
}
