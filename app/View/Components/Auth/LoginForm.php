<?php

namespace App\View\Components\Auth;

use PhpParser\Node\Expr\Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class LoginForm extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public $pwvisible)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.auth.login-form');
    }
}
