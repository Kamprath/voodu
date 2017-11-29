<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Card extends Model
{
    protected $fillable = ['name', 'description', 'position', 'board_id', 'column_id', 'swimlane_id'];

    /**
     * Get board that card belongs to
     *
     * @return BelongsTo
     */
    public function board(): BelongsTo
    {
        return $this->belongsTo(Board::class);
    }

    /**
     * Get swimlane that card belongs to
     *
     * @return BelongsTo
     */
    public function swimlane(): BelongsTo
    {
        return $this->belongsTo(Swimlane::class);
    }

    /**
     * Get column that card belongs to
     *
     * @return BelongsTo
     */
    public function column(): BelongsTo
    {
        return $this->belongsTo(Column::class);
    }
}
