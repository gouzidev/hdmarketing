<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    function getLoginPage(Request $req)
    {
        return view("login");
    }

    function login(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'email' => 'required|min:8|max:30',
            'password' => 'required|min:8|max:30'
        ]);
        if ($validator->fails())
        {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }
        $validated = $validator->validated();

        return redirect('/');
    }
    function register(Request $req)
    {
        return view("login");
    }
    function getRegisterPage(Request $req)
    {
        return view("register");
    }
}
