<?php

namespace App\Http\Controllers\Auth;

use App\Contracts\Auth\PasswordResetServiceInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    public function page()
    {
        return view('pages.forgot-password');
    }

    public function action(Request $request, PasswordResetServiceInterface $service)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $service->send($request->get('email'));

        return redirect()->route('auth.login.page');
    }
}
