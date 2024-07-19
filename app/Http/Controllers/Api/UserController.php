<?php

namespace App\Http\Controllers\Api;

use App\Contracts\User\ApiGetUserServiceInterface;
use App\Contracts\User\UserCreateServiceInterface;
use App\Contracts\User\UserUpdateServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\UserCreateRequest;
use App\Http\Requests\Api\User\UserIndexRequest;
use App\Http\Requests\Api\User\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\User;

class UserController extends Controller
{
    public function index(UserIndexRequest $request, ApiGetUserServiceInterface $service)
    {
        $service->setParameters($request->validated());

        return $service->get();
    }

    public function store(UserCreateRequest $request, UserCreateServiceInterface $service)
    {
        $userService = $service->execute($request->validated());

        return $this->show($userService->get());
    }

    public function show(User $user)
    {
        return new UserResource($user);
    }

    public function update(UserUpdateRequest $request, User $user, UserUpdateServiceInterface $service)
    {
        $service->set($user);
        $service->update($request->validated());

        return $this->show($service->get());
    }

    public function destroy(User $user)
    {
        $user->delete();

        return $this->apiRes(status: 204);
    }
}
