<?php

namespace App\Http\Controllers;

use App\Contracts\PasswordResetServiceInterface;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\Models\User\UserModifyService;
use App\Services\Models\User\UserService;
use Illuminate\Http\Request;

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

    public function forgotPasswordPage()
    {
        return view('pages.forgot-password');
    }

    public function forgotPasswordAction(Request $request, PasswordResetServiceInterface $service)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $service->sendResetLink($request->get('email'));

        return $this->forgotPasswordPage()->with(['success' => true]);
    }
}
