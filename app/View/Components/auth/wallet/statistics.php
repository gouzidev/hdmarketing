<?php

namespace App\View\Components\auth\wallet;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class statistics extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public $numOrders, public $totalSales, public $totalProfit, public $numNextOrders, public $nextProfit)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.auth.wallet.statistics');
    }
}
