<?php

namespace App\Repositories;

use App\Board;

class BoardRepository extends Repository {

    protected $model = Board::class;

    protected $orderBy = 'name asc';

}