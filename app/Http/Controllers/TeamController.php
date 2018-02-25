<?php

namespace App\Http\Controllers;

use App\Repositories\TeamRepository;
use App\Team;
use Auth;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    protected $teams;

    public function __construct()
    {
        $this->teams = new TeamRepository();
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // make sure user does not belong to a team already
        if (!Auth::user()->team_id) {
            return response()
                ->json([ 'message' => 'You cannot create another team.' ], self::STATUS_FORBIDDEN);
        }

        try {
            return response()->json(
                $this->teams->create($request->all()),
                self::STATUS_CREATED
            );
        } catch (\Exception $e) {
            return $this->error($e);
        }

        // todo: create Stripe subscription and Subscription record
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Swimlane  $swimlane
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Swimlane  $swimlane
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Swimlane  $swimlane
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Team $team)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Swimlane  $swimlane
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team)
    {
        //
    }
}
