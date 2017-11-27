<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    protected $fillable = [ 'name', 'purpose', 'is_public', 'created_by' ];
}