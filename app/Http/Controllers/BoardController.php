<?php

namespace App\Http\Controllers;

use App\Board;
use App\Repositories\BoardRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BoardController extends Controller
{
    protected $boards;

    public function __construct(BoardRepository $boards)
    {
        $this->middleware('auth:api');
        $this->boards = $boards;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return $this->boards->all();
    }

    /**
     * Store a new Board in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request) : JsonResponse
    {
        try {
            return response()->json(
                $this->boards->create($request->all()),
                201
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Board $board
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Repositories\RepositoryException
     */
    public function update(Request $request, Board $board) : JsonResponse
    {
        if (!$board) {
            return response()->json(['message' => 'Board not found.'], 404);
        }

        if ($board->created_by !== \Auth::id()) {
            return response()
                ->json([ 'message' => 'You do not have permission to edit this board.' ], self::STATUS_FORBIDDEN);
        }

        try {
            return response()->json(
                $this->boards->update($request->all(), $board->id)
            );
        } catch (\Exception $e) {
            return $this->error($e);
        }
    }

    public function destroy($id) : JsonResponse
    {
        try {
            $this->boards->delete($id);
            return response()->json(null, 204);
        } catch (Exception $e) {
            return $this->error($e);
        }
    }
}
