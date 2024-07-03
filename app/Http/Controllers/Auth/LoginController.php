<?php

namespace App\Http\Controllers\Auth;

use App\Contracts\User\UserServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;

class LoginController extends Controller
{
    public function page()
    {
        return view('pages.login');
    }

    public function action(LoginRequest $request, UserServiceInterface $service)
    {
        if ($service->attempt($request->validated())) {
            return redirect()->route(config('routes.web.home'));
        }

        return $this->page()->with([
            'error' => __('auth.error_messages.1')
        ]);
    }
}
