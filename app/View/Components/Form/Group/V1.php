<?php

namespace App\View\Components\Form\Group;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class V1 extends Component
{
    public function __construct(
        public string $name,
        public string $label,
        public string $type = 'text',
    )
    {
        //
    }

    public function render(): View|Closure|string
    {
        return view('components.form.group.v1');
    }
}
