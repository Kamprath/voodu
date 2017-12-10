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
        } catch (\Exception $e) {
            return $this->error($e);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Card $card
     * @return \Illuminate\Http\Response
     * @throws \App\Repositories\RepositoryException
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
     * Update multiple cards
     *
     * @param Request $request  Request body must contain model data as a JSON array of objects
     * @return JsonResponse
     * @throws \App\Repositories\RepositoryException
     */
    public function updateMany(Request $request) : JsonResponse
    {
        $models = [];

        foreach ($request->all() as $modelData) {
            $card = Card::find($modelData['id']);

            if (!$card) {
                return repsonse()->json([
                    'message' => 'Card with ID ' .$modelData['id'] . ' does not exist.'
                ], self::STATUS_NOT_FOUND);
            }

            // make sure user has access to board
            if (!\Auth::user()->hasBoard($card->board_id)) {
                return response()->json([
                    'message' => 'You do not have access to a board that one or more of the cards belongs to.'
                ], self::STATUS_FORBIDDEN);
            }

            // update model
            try {
                $models[] = $this->cards->update([
                    'column_id' => $modelData['column_id'],
                    'position' => $modelData['position']
                ], $card->id);
            } catch (\Exception $e) {
                return $this->error($e);
            }
        }

        return response()->json(collect($models));
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
        } catch (\Exception $e) {
            return $this->error($e);
        }
    }
}