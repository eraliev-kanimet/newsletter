<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;

class SiteController extends Controller
{
    public function locale(string $locale)
    {
        App::setLocale($locale);

        session(['locale' => $locale]);

        return redirect()->back();
    }
}
