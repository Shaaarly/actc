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
  @include('partials.navbar')
  <div class="d-flex" style="min-height: 100vh;">
        <div class="bg-primary p-0 sidebar">
            @include('partials.sidebar')
          </div>
          {{-- <div class="col-1 col-sm-1 col-md-1 bg-primary p-0 sidebar z-2">
            @include('partials.sidebar')
          </div> --}}
          
          <div class="container main-content flex-grow-1 p-3">
            @yield('content')
          </div>
    </div>
  
  @stack('scripts')
</body>
</html>
