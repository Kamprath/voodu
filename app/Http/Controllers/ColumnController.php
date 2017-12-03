<?php

namespace App\Http\Controllers;

use App\Board;
use App\Column;
use App\Repositories\ColumnRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ColumnController extends Controller
{
    protected $columns;

    public function __construct(ColumnRepository $columns)
    {
        $this->middleware('auth:api');
        $this->columns = $columns;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        // todo: only return columns for boards that the user has access to
        return $this->columns->all();
    }

    /**
     * Store a new Column in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request) : JsonResponse
    {
        // make sure user has access to board they're submitting column for
        if (!\Auth::user()->hasBoard((int) $request->get('board_id'))) {
            return response()
                ->json([ 'message' => 'You do not have access to this board.' ], self::STATUS_FORBIDDEN);
        }

        try {
            return response()->json(
                $this->columns->create($request->all()),
                self::STATUS_CREATED
            );
        } catch (Exception $e) {
            return $this->error($e);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Board $board
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Board $board)
    {
        // todo: implement show() method
        // todo: only show board if user has access
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Column $column
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Column $column)
    {
        if (!$column) {
            return response()->json(['message' => 'Column not found.'], 404);
        }

        if (!\Auth::user()->hasBoard((int) $request->get('board_id'))) {
            return response()
                ->json([ 'message' => 'You do not have access to this board.' ], self::STATUS_FORBIDDEN);
        }

        try {
            return response()->json(
                $this->columns->update($request->all(), $column->id)
            );
        } catch (\Exception $e) {
            return $this->error($e);
        }
    }

    /**
     * @param Request $request
     * @param Column $column
     * @return JsonResponse
     * @throws \Exception
     */
    public function destroy(Column $column) : JsonResponse
    {
        if (!\Auth::user()->hasBoard($column->board_id)) {
            return response()
                ->json([ 'message' => 'You do not have access to this board.' ], self::STATUS_FORBIDDEN);
        }

        try {
            $this->columns->delete($column->id);
            return response()->json(null, self::STATUS_DELETED);
        } catch (Exception $e) {
            return $this->error($e);
        }
    }
}
