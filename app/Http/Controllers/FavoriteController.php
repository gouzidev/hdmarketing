<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\User;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function index(User $user)
    {
        $favorites = Favorite::with ('product')->where('user_id', $user->id)->get();
        return view ('favorites.index', ['favorites' => $favorites]);
    }
}
