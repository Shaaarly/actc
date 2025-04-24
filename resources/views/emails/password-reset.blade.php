@extends('emails.layouts.app')

@section('content')
    <h2>🔒 ¿Olvidaste tu contraseña?</h2>

    <p>Hola {{ $user->name->name ?? 'usuario' }},</p>

    <p>Hemos recibido una solicitud para restablecer la contraseña de tu cuenta. Puedes crear una nueva contraseña de forma segura haciendo clic en el botón de abajo:</p>

    <a href="{{ $url }}" class="btn">Restablecer contraseña</a>

    <p>Este enlace expirará en 60 minutos.</p>

    <p>Si no solicitaste este cambio, puedes ignorar este mensaje.</p>

    <div class="footer">
        Gracias por confiar en nosotros.<br>
        El equipo de {{ config('app.name') }}
    </div>
@endsection
