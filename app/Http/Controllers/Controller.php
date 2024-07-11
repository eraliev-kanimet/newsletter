<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

abstract class Controller
{
    protected function apiRes(array $data = [], int $status = 200)
    {
        return response()->json($data, $status);
    }

    protected function notValidParameter(string $value, array $array)
    {
        if (!in_array($value, $array)) {
            throw new NotFoundHttpException;
        }
    }
}
