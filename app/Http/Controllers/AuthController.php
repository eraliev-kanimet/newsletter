<?php

namespace App\Http\Controllers;

use App\Contracts\PasswordResetServiceInterface;
use App\Exceptions\PasswordResetException;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\PasswordResetRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\PasswordResetToken;
use App\Services\Models\User\UserModifyService;
use App\Services\Models\User\UserService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected function redirectToHomePage()
    {
        return redirect()->route(config('routes.web.home'));
    }

    protected function redirectToLoginPage()
    {
        return redirect()->route('auth.login.page');
    }

    public function registerPage()
    {
        return view('pages.register');
    }

    public function registerAction(RegisterRequest $request)
    {
        $service = UserModifyService::create($request->validated());

        $service->login();

        return $this->redirectToHomePage();
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

        $service->sendLink($request->get('email'));

        return $this->redirectToLoginPage();
    }

    public function passwordResetPage(Request $request)
    {
        $resetToken = PasswordResetToken::whereToken($request->get('token'))->firstOrFail();

        return view('pages.password-reset', compact('resetToken'));
    }

    public function passwordResetAction(PasswordResetRequest $request, PasswordResetServiceInterface $service)
    {
        try {
            $service->reset(
                $request->get('token'),
                $request->get('password')
            );
        } catch (PasswordResetException) {
            return $this->redirectToLoginPage();
        }

        return $this->redirectToHomePage();
    }
}
