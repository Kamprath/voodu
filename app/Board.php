<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Board extends Model implements ApiModelInterface
{
    protected $fillable = [ 'title', 'description' ];

    public function toApi() : array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'created_at' => $this->created_at
        ];
    }
}
