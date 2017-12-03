<?php

namespace App\Repositories;

use App\Column;

class ColumnRepository extends Repository {

    protected $model = Column::class;

    protected $orderBy = 'position asc';

}