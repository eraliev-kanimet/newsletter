<?php

namespace App\Http\Controllers\Auth;

use App\Contracts\PasswordResetServiceInterface;
use App\Exceptions\PasswordResetException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\PasswordResetRequest;
use Illuminate\Http\Request;

class PasswordResetController extends Controller
{
    public function page(Request $request, PasswordResetServiceInterface $service)
    {
        return view('pages.password-reset', [
            'resetToken' => $service->findOrFailByToken($request->get('token')),
        ]);
    }

    public function action(PasswordResetRequest $request, PasswordResetServiceInterface $service)
    {
        try {
            $service->reset(
                $request->get('token'),
                $request->get('password')
            );
        } catch (PasswordResetException) {
            return redirect()->route('auth.login.page');
        }

        return redirect()->route(config('routes.web.home'));
    }
}
