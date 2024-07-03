<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\UserCreationOrderException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\Models\User\UserCreateService;

class RegisterController extends Controller
{
    public function page()
    {
        return view('pages.register', [
            'success' => request()->has('success'),
        ]);
    }

    public function order(RegisterRequest $request, UserCreateService $service)
    {
        $service->placeOrder($request->validated());

        return redirect()->route('auth.register.page', ['success' => true]);
    }

    public function action($token, UserCreateService $service)
    {
        try {
            $service->withOrder($token);
        } catch (UserCreationOrderException) {
            return view('pages.expired.register');
        }

        return redirect()->route(config('routes.web.home'));
    }
}
