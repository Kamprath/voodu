<?php

namespace App\Http\Controllers;

use App\Repositories\BoardRepository;
use App\Repositories\TaskRepository;
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
     * @throws \RuntimeException
     */
    public function index() : View
    {
        return $this->response();
    }

    /**
     * Get default bootstrapped data
     *
     * @return array
     * @throws \RuntimeException
     */
    protected function getBootstrapped() : array
    {
        return [
            'user' => \Auth::user(),
            'boards' => [
                'models' => $this->boards->all(['*'], [
                    'swimlanes' => 'position asc',
                    'columns' => 'position asc',
                    'cards' => 'position asc'
                ])
            ]
        ];
    }

    /**
     * Return app view with bootstrapped data injected
     *
     * @param array $data Non-default bootstrapped data to pass to Vue
     * @return \Illuminate\Contracts\View\Factory|View
     * @throws \RuntimeException
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
