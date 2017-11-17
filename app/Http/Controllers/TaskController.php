<?php

namespace App\Http\Controllers;

use App\Repositories\TaskRepository;
use App\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Mockery\Exception;

class TaskController extends Controller
{
    /**
     * @var TaskRepository
     */
    protected $tasks;

    public function __construct(TaskRepository $tasks)
    {
        $this->middleware('auth');
        $this->tasks = $tasks;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return $this->tasks->all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $task = new Task([
            'title' => $request->title
        ]);

        return response()->json(['success' => $task->save()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task $task
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     * @throws \InvalidArgumentException
     */
    public function destroy(Task $task) : JsonResponse
    {
        $response = [
            'success' => false
        ];

        if ($task) {
            try {
                $response['success'] = $task->delete();
            } catch (Exception $e) {
                $response['message'] = $e->getMessage();
            }
        }

        return response()
            ->json($response)
            ->setStatusCode($response['success'] ? 200 : 500);
    }
}
