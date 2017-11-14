<?php

namespace App\Repositories;

interface RepositoryInterface {

    /**
     * Get all models
     */
    public function all();

    /**
     * Find model by ID
     *
     * @param $id
     */
    public function find($id);

}