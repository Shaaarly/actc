<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Mi Aplicación')</title>
  @vite(['resources/sass/app.scss', 'resources/js/app.js'])
  @stack('styles')
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/f03bcf4820.js" crossorigin="anonymous"></script>
</head>
<body>
  <div class="d-flex h-100">
    @auth
      @if(in_array(auth()->user()->role_id, [2, 3]))
          <!-- Sidebar: ocupa toda la altura a la izquierda -->
          <div class="p-0 sidebar">
              @include('partials.sidebar')
          </div>
      @endif
    @endauth


    <div class="d-flex flex-column flex-grow-1">

      <div class="bg-white">
        @include('partials.navbar')
      </div>
      
      {{-- Alerta para informar de confirmacion de correo --}}
      @if(auth()->check() && !auth()->user()->hasVerifiedEmail())
        <div class="alert alert-warning text-center">
            Verifica tu correo electrónico para acceder a todas las funciones.
            <form method="POST" action="{{ route('verification.send') }}" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-sm btn-warning">Reenviar verificación</button>
            </form>
        </div>
      @endif
      @php
        $isAuth = request()->routeIs('login') || request()->routeIs('register');
      @endphp

      <div class="bg-white p-3 @if($isAuth) auth-content h-100 d-flex align-items-center justify-content-center @else main-content flex-grow-1 @endif ">
        
        @include('partials.alerts')

        @yield('content')
      </div>
    </div>
  </div>

  
  @vite('resources/js/propertyForm.js')
  @vite('resources/js/usersForm.js')
  @stack('scripts')

  @if(session('show_2fa_modal'))
    @include('components.modals.two-factor-prompt')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const modal = new bootstrap.Modal(document.getElementById('twoFactorPrompt'));
            modal.show();
        });
    </script>
  @endif

</body>
</html>
