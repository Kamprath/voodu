<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BoardController extends Controller
{
    public function show($id)
    {
        return view('boards.board');
    }
}
