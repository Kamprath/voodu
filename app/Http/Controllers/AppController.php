<?php

namespace App\Http\Controllers;

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
     * Initialize controller
     *
     * AppController constructor.
     * @param TaskRepository $tasks
     */
    public function __construct(TaskRepository $tasks)
    {
        $this->middleware('auth');
        $this->tasks = $tasks;
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
                'message' => \Illuminate\Foundation\Inspiring::quote()
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
     * Get default bootstrapped data
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
