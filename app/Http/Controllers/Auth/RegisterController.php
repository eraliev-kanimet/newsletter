<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    public function page()
    {
        return view('pages.register', [
            'success' => request()->has('success'),
        ]);
    }
}
