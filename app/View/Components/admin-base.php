<?php

namespace App\View\Components;

use App\Models\Faculte;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class admin-base extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public Collection $Faculte)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin-base');
    }
}
