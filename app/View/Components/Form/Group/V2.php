<?php

namespace App\View\Components\Form\Group;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class V2 extends Component
{
    public function __construct(
        public string           $name,
        public string           $label,
        public string           $url,
        public string           $urlLabel,
        public string|int|float|null $value = '',
        public string           $type = 'text',
        public bool             $disabled = false,
    )
    {
        if ($type != 'password' && $value == '') {
            $this->value = old($name, $value);
        }
    }

    public function render(): View|Closure|string
    {
        return view('components.form.group.v2');
    }
}
