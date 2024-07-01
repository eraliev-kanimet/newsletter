<?php

namespace App\View\Components\Form\Group;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class V2 extends Component
{
    public function __construct(
        public string $name,
        public string $label,
        public string $url,
        public string $urlLabel,
        public string $type = 'text',
    )
    {
        //
    }

    public function render(): View|Closure|string
    {
        return view('components.form.group.v2');
    }
}
