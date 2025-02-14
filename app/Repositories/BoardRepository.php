<?php

namespace App\Repositories;

use App\Board;
use App\Card;
use App\Column;
use App\Swimlane;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BoardRepository extends Repository {

    protected $model = Board::class;

    protected $orderBy = 'name asc';

    /**
     * Create a new board.
     *
     * @param array $data
     * @return Model
     */
    public function create(array $data): Model
    {
        $board = new Board($data);
        $board->created_by = \Auth::id();
        $board->save();

        // create a default Swimlane
        $swimlane = new Swimlane;
        $swimlane->created_by = \Auth::id();
        $swimlane->board_id = $board->id;
        $swimlane->save();
        $swimlane->cards = [];
        $board->swimlanes = collect([$swimlane]);

        // append placeholder arrays for relationships
        $board->columns = $board->cards = [];

        return $board;
    }

    /**
     * Delete a board.
     *
     * @param int $id
     * @return bool
     */
    public function delete($id): bool
    {
        Card::where('board_id', $id)->delete();
        Column::where('board_id', $id)->delete();
        Swimlane::where('board_id', $id)->delete();
        return parent::delete($id);
    }

    /**
     * Get all boards that the user has access to.
     *
     * @param array $columns
     * @param array $with
     * @return Collection
     * @throws \RuntimeException
     */
    public function all(array $columns = ['*'], array $with = []): Collection
    {
        $boards = parent::all($columns, $with);

        // filter out boards that user doesn't have access to
        return $boards->filter(function($board) {
            return $board->is_public || $board->created_by === \Auth::id();
        });
    }

}