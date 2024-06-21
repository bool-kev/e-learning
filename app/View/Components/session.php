<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class session extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public string $key,public ?string $type)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.session');
    }
}
