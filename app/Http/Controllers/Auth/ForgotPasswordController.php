<?php

namespace App\Http\Controllers\Auth;

use App\Contracts\Auth\PasswordResetServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\EmailRequest;

class ForgotPasswordController extends Controller
{
    public function page()
    {
        return view('pages.forgot-password');
    }

    public function action(EmailRequest $request, PasswordResetServiceInterface $service)
    {
        $service->send($request->get('email'));

        return redirect()->route('auth.login.page');
    }
}
