<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserGetRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\Models\Api\User\UserGetService;

class UserController extends Controller
{
    public function index(UserGetRequest $request, UserGetService $service)
    {
        $service->setParameters($request->validated());

        return $service->get();
    }
    public function show(User $user)
    {
        return new UserResource($user);
    }
}
