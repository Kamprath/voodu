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
                $this->boards->create([
                    'name' => $request->get('name'),
                    'purpose' => $request->get('purpose'),
                    'is_public' => $request->get('is_public', 0),
                    'created_by' => \Auth::id()
                ]),
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
     * @param  \App\Board               $board
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Board $board)
    {
        //
    }

    public function destroy(Board $board) : JsonResponse
    {
        try {
            $board->delete();
            return response()->json(null, 204);
        } catch (Exception $e) {
            return $this->error($e);
        }
    }
}
