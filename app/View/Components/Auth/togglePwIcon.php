<?php

namespace App\View\Components\auth;

use PhpParser\Node\Expr\Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class togglePwIcon extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.auth.toggle-pw-icon');
    }
}
