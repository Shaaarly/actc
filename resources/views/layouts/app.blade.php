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
  <div class="d-flex" style="min-height: 100vh;">
    <!-- Sidebar: ocupa toda la altura a la izquierda -->
    <div class=" p-0 sidebar">
      @include('partials.sidebar')
    </div>
  
    <!-- Contenedor derecho: navbar arriba y contenido principal abajo -->
    <div class="d-flex flex-column flex-grow-1">
      <!-- Navbar (gris) en la parte superior del contenedor derecho -->
      <div class="bg-secondary">
        @include('partials.navbar')
      </div>
      <!-- Contenido principal (blanco) que ocupa el resto del espacio -->
      <div class="flex-grow-1 bg-white p-3 main-content">
        
        @include('partials.alerts')



        @yield('content')
      </div>
    </div>
  </div>
  
  @vite('resources/js/propertyForm.js')
  @vite('resources/js/usersForm.js')
  @stack('scripts')
</body>
</html>
