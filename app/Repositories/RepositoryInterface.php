<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface RepositoryInterface {

    public function all($columns = array('*')) : Collection;

    public function paginate($perPage = 15, $columns = array('*'));

    public function create(array $data) : Model;

    public function update(array $data, $id) : Model;

    public function delete($id) : bool;

    public function find($id, $columns = array('*')) : Model;

    public function findBy($field, $value, $columns = array('*')) : Model;

}