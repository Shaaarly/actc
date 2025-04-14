<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PasswordController extends Controller
{
    /**
     * Muestra el formulario para que el usuario solicite el enlace de restablecimiento.
     *
     * @return \Illuminate\View\View
     */
    public function showForgotForm()
    {
        return view('auth.password.forgot'); // Vista: resources/views/auth/password/forgot.blade.php
    }

    /**
     * Procesa el formulario de "olvidé mi contraseña" y envía el enlace de restablecimiento.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendResetLinkEmail(Request $request)
    {
        // Validar que se envíe un correo electrónico válido
        $request->validate([
            'email' => 'required|email',
        ]);

        // Se usa el broker de contraseñas para enviar el enlace
        $status = Password::sendResetLink($request->only('email'));

        // Redirigir de acuerdo al resultado
        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withErrors(['email' => __($status)]);
    }

    /**
     * Muestra el formulario para que el usuario ingrese su nueva contraseña.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $token Token enviado por correo
     * @return \Illuminate\View\View
     */
    public function showResetForm(Request $request, $token)
    {
        // Capturamos el email que se puede enviar como query string (por ejemplo, ?email=usuario@dominio.com)
        $email = $request->query('email');
        return view('auth.password.reset', compact('token', 'email'));
    }

    /**
     * Procesa el formulario de restablecimiento de contraseña (reset password) y actualiza la contraseña.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        // Validamos los datos enviados (token, email, nueva contraseña y su confirmación)
        $request->validate([
            'token'                 => 'required',
            'email'                 => 'required|email',
            'password'              => 'required|confirmed|min:8', // Cambia las reglas según tus necesidades
        ]);

        // Se intenta restablecer la contraseña usando el broker de contraseñas
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                // Se actualiza la contraseña y se genera un nuevo token de "remember me"
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->save();

                $user->setRememberToken(Str::random(60));
            }
        );

        // Se redirige según el resultado del restablecimiento
        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
}
