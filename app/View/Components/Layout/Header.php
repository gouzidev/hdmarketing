<?php

namespace App\View\Components\Layout;

use PhpParser\Node\Expr\Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Header extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $headerText,
        public string $icon = '',
        public bool $btnExist = false,
        public string $btnLink = '',
        public string $btnText = '',
        public string $btnClass = '',
        public string $btnIcon = '',
        public bool $showForUser = true,
        
    )
    {

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.layout.header');
    }
}
