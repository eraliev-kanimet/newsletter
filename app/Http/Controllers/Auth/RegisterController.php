<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\Models\User\UserModifyService;

class RegisterController extends Controller
{
    public function page()
    {
        return view('pages.register');
    }

    public function action(RegisterRequest $request)
    {
        $service = UserModifyService::create($request->validated());

        $service->login();

        return redirect()->route(config('routes.web.home'));
    }
}
