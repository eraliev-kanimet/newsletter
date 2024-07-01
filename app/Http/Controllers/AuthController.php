<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\Models\User\UserModifyService;
use App\Services\Models\User\UserService;

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

    public function loginPage()
    {
        return view('pages.login');
    }

    public function loginAction(LoginRequest $request)
    {
        if (UserService::attempt($request->validated())) {
            return redirect()->route(config('routes.web.home'));
        }

        return $this->loginPage()->with([
            'error' => __('auth.error_messages.1')
        ]);
    }
}
