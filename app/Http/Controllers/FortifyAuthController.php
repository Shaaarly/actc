<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FortifyAuthController extends Controller
{
    public function login()
    {

        return view('auth.login');
    }

    public function register()
    {
        
        return view('auth.register');
    }

    public function passwordRequest()
    {
        return view('auth.password.request');
    }

    public function resetPassword(Request $request, $token)
    {
        // Se puede pasar el email desde el querystring (por ejemplo, ?email=usuario@dominio.com)
        $email = $request->query('email');
        return view('auth.password.reset', compact('token', 'email'));
    }
    
}

