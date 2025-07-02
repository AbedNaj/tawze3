<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\LoginRequest;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    public function index()
    {

        return view('admin.auth.login');
    }


    public function store(LoginRequest $loginRequest)
    {

        $loginRequest->authenticated();


        request()->session()->regenerate();


        return redirect()->intended(route('admin.dashboard'));
    }
}
