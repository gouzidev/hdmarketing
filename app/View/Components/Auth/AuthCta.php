<?php

namespace App\View\Components;

use PhpParser\Node\Expr\Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AuthCta extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public string $title, public string $message)
    {
        
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.auth.auth-cta');
    }
}
