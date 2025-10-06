<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class RegisterController extends Controller
{
    public function show()
    {
        return view('register');
    }

    public function store(\App\Http\Requests\RegisterRequest $request,\Laravel\Fortify\Contracts\CreatesNewUsers $creator)
    {
        $data = $request->validated();
        $creator->create($data);
        return redirect('/login');
    }
}
