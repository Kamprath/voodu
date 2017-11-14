<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class TasksRepository implements RepositoryInterface {

    public function paginate($perPage = 15, $columns = array('*'))
    {
        // TODO: Implement paginate() method.
    }

    public function create(array $data): Model
    {
        // TODO: Implement create() method.
    }

    public function update(array $data, $id): Model
    {
        // TODO: Implement update() method.
    }

    public function delete($id): bool
    {
        // TODO: Implement delete() method.
    }

    public function findBy($field, $value, $columns = array('*')): Model
    {
        // TODO: Implement findBy() method.
    }

    public function all($columns = array('*')): Collection
    {
        return new Collection();
    }

    public function find($id, $columns = array('*')): Model
    {
        // TODO: Implement find() method.
    }
}