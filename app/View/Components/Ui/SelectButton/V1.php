<?php

namespace App\View\Components\Ui\SelectButton;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class V1 extends Component
{
    public function __construct(
        public string $name,
        public string $click,
        public array $options = [],
    )
    {
        //
    }

    public function render(): View|Closure|string
    {
        return view('components.ui.select-button.v1');
    }
}
