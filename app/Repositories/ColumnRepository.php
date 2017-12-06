<?php

namespace App\Repositories;

use App\Card;
use App\Column;
use Illuminate\Database\Eloquent\Model;

class ColumnRepository extends Repository {

    protected $model = Column::class;

    protected $orderBy = 'position asc';

    /**
     * Create a new column.
     *
     * @param array $data
     * @return Model
     */
    public function create(array $data): Model
    {
        $column = new Column($data);
        $column->created_by = \Auth::id();
        $column->save();

        return $column;
    }

    /**
     * Delete a column.
     *
     * @param int $id
     * @return bool
     */
    public function delete($id): bool
    {
        Card::where('column_id', $id)->delete();
        return parent::delete($id);
    }

}