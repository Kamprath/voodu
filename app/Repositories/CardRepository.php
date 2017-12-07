<?php

namespace App\Repositories;

use App\Card;
use Illuminate\Database\Eloquent\Model;

class CardRepository extends Repository {

    protected $model = Card::class;

    protected $orderBy = 'position asc';

    /**
     * Create a new card.
     *
     * @param array $data
     * @return Model
     */
    public function create(array $data): Model
    {
        $card = new Card($data);
        $card->created_by = \Auth::id();
        $card->save();

        return $card;
    }

}