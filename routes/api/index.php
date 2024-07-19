<?php

use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Api\ReceiverController;
use App\Http\Controllers\Api\SendingProcessController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::apiResource('users', UserController::class);

Route::apiResource('messages', MessageController::class);

Route::apiResource('receivers', ReceiverController::class);

Route::apiResource('sending-processes', SendingProcessController::class);
