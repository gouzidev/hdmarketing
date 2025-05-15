<?php

namespace App\View\Components;

use PhpParser\Node\Expr\Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class selectCountry extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct($county)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.select-country');
    }
}
