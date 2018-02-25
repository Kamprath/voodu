<?php

namespace App\Repositories;

use App\Team;
use Illuminate\Database\Eloquent\Model;

class TeamRepository extends Repository {

    protected $model = Team::class;

    public function create(array $data): Model
    {
        $team = new Team($data);
        $team->created_by = \Auth::id();
        $team->save();

        return $team;
    }
}