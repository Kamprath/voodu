<?php

namespace App\Repositories;

class TasksRepository implements RepositoryInterface {

    /**
     * Get all models
     */
    public function all()
    {
        return ['Task A', 'Task B', 'Task C'];
    }

    public function find($id)
    {
        return;
    }
}