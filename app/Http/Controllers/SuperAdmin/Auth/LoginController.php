<?php

namespace App\Http\Controllers\SuperAdmin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\superAdmin\Auth\LoginRequest;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('super-admin.auth.login');
    }


    public function store(LoginRequest $loginRequest)
    {

        $loginRequest->authenticated();


        request()->session()->regenerate();


        return redirect()->intended('/dashboard');
    }
}
