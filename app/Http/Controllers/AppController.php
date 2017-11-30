<?php

namespace App\Http\Controllers;

use App\Board;
use App\Repositories\BoardRepository;
use App\Repositories\TaskRepository;
use Illuminate\Foundation\Inspiring;
use Illuminate\View\View;

/**
 * Class AppController
 * @package App\Http\Controllers
 */
class AppController extends Controller
{
    /**
     * @var TaskRepository
     */
    protected $tasks;

    /**
     * @var BoardRepository
     */
    protected $boards;

    /**
     * Initialize controller
     *
     * AppController constructor.
     * @param TaskRepository $tasks
     * @param BoardRepository $boards
     */
    public function __construct(TaskRepository $tasks, BoardRepository $boards)
    {
        $this->middleware('auth');
        $this->tasks = $tasks;
        $this->boards = $boards;
    }

    /**
     * Display view with bootstrapped data
     *
     * @return \Illuminate\Contracts\View\Factory|View
     */
    public function index() : View
    {
        return $this->response([
            'dashboard' => [
                'message' => Inspiring::quote()
            ]
        ]);
    }

    /**
     * Display view with bootstrapped Tasks data
     *
     * @return \Illuminate\Contracts\View\Factory|View
     */
    public function tasks() : View
    {
        return $this->response([
//            'tasks' => $this->tasks->all()
        ]);
    }

    /**
     * Display view with bootstrapped Board data
     *
     * @param Board $board
     * @return \Illuminate\Contracts\View\Factory|View
     */
    public function board(Board $board) : View
    {
        return $this->response([
            'board' => !empty($board) ? $board : null
        ]);
    }

    /**
     * Get default bootstrapped data
     *
     * @return array
     */
    protected function getBootstrapped() : array
    {
        return [
            'user' => null,
            'boards' => [
                'models' => $this->boards->all(['*'], [
                    'swimlanes' => 'position asc',
                    'columns' => 'position asc',
                    'cards' => 'position asc'
                ])
            ],
            'projects' => null
        ];
    }

    /**
     * Return app view with bootstrapped data injected
     *
     * @param array $data   Non-default bootstrapped data to pass to Vue
     * @return \Illuminate\Contracts\View\Factory|View
     */
    protected function response(array $data = []) : View
    {
        return view('index', [
            'bootstrapped' => array_merge(
                $this->getBootstrapped(),
                $data
            )
        ]);
    }
}
