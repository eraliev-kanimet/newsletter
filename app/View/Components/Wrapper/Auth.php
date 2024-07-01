<?php

namespace App\View\Components\Wrapper;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Auth extends Component
{
    public function __construct(
        public string $title
    )
    {
        //
    }

    public function render(): View|Closure|string
    {
        return view('components.wrapper.auth');
    }
}
