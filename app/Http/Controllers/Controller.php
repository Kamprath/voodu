<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected const STATUS_CREATED = 201;
    protected const STATUS_DELETED = 204;
    protected const STATUS_BAD_REQUEST = 400;
    protected const STATUS_FORBIDDEN = 403;
    protected const STATUS_NOT_FOUND = 404;
    protected const STATUS_SERVER_ERROR = 500;


    protected function error(Exception $e) : JsonResponse
    {
        return response()->json($e, self::STATUS_SERVER_ERROR);
    }
}
