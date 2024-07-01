<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\RegisterRequest;
use App\Services\Models\User\UserModifyService;

class AuthController extends Controller
{
    public function registerPage()
    {
        return view('pages.register');
    }

    public function registerAction(RegisterRequest $request)
    {
        $service = UserModifyService::create($request->validated());

        $service->login();

        return redirect()->route(config('routes.web.home'));
    }
}
