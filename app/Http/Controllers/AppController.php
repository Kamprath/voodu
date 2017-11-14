<?php

namespace App\Http\Controllers;

use App\Repositories\TasksRepository;
use Illuminate\View\View;

/**
 * Class AppController
 * @package App\Http\Controllers
 */
class AppController extends Controller
{
    /**
     * @var TasksRepository
     */
    protected $tasks;

    /**
     * Initialize controller
     *
     * AppController constructor.
     * @param TasksRepository $tasks
     */
    public function __construct(TasksRepository $tasks)
    {
        $this->tasks = $tasks;
    }

    /**
     * Display app view with bootstrapped data
     *
     * @return \Illuminate\Contracts\View\Factory|View
     */
    public function index() : View
    {
        return $this->response();
    }

    /**
     * Display view with Tasks data * Display view with Tasks data injected
     *
     * @return \Illuminate\Contracts\View\Factory|View
     */
    public function tasks() : View
    {
        return $this->response([
            'tasks' => $this->tasks->all()
        ]);
    }

    /**
     * Get default bootstrapped data to pass to Vue
     *
     * @return array
     */
    protected function getBootstrapped() : array
    {
        return [
            'user' => null,
            'boards' => null,
            'projects' => null
        ];
    }

    /**
     * Return app view with bootstrapped data
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
