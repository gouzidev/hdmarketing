<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelperMethodsController extends Controller
{
    static public function abs($x)
    {
        if ($x >= 0)
            return $x;
        return -$x;
    } 
}
