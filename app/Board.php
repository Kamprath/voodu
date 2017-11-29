<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    protected $fillable = [ 'name', 'purpose', 'is_public', 'created_by' ];

    /**
     * Get board columns
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function columns()
    {
        return $this->hasMany(Column::class);
    }

    /**
     * Get swimlanes
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function swimlanes()
    {
        return $this->hasMany(Swimlane::class);
    }

    /**
     * Get all cards that belong to the board
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cards()
    {
        return $this->hasMany(Card::class);
    }
}