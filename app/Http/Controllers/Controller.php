<?php

namespace App\Http\Controllers;

abstract class Controller
{
    protected function apiRes(array $data = [], int $status = 200)
    {
        return response()->json($data, $status);
    }
}
