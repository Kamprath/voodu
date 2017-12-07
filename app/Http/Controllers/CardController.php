<?php

namespace App\Http\Controllers;

use App\Card;
use App\Repositories\CardRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CardController extends Controller
{
    protected $cards;

    public function __construct(CardRepository $cards)
    {
        $this->middleware('auth:api');
        $this->cards = $cards;
    }

    /**
     * Store a newly created resource in storage.
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
                $this->cards->create($request->all()),
                self::STATUS_CREATED
            );
        } catch (Exception $e) {
            return $this->error($e);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Card $card)
    {
        if (!$card) {
            return response()->json(['message' => 'Card not found.'], 404);
        }

        if (!\Auth::user()->hasBoard((int) $request->get('board_id'))) {
            return response()
                ->json([ 'message' => 'You do not have access to this board.' ], self::STATUS_FORBIDDEN);
        }

        try {
            return response()->json(
                $this->cards->update($request->all(), $card->id)
            );
        } catch (\Exception $e) {
            return $this->error($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function destroy(Card $card)
    {
        if (!\Auth::user()->hasBoard($card->board_id)) {
            return response()
                ->json([ 'message' => 'You do not have access to this board.' ], self::STATUS_FORBIDDEN);
        }

        try {
            $this->cards->delete($card->id);
            return response()->json(null, self::STATUS_DELETED);
        } catch (Exception $e) {
            return $this->error($e);
        }
    }
}