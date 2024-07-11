<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;

class SiteController extends Controller
{
    public function locale(string $locale)
    {
        $this->notValidParameter($locale, array_keys(config('app.locales')));

        App::setLocale($locale);

        session(['locale' => $locale]);

        return redirect()->back();
    }
}
