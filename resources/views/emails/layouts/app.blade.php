<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? config('app.name') }}</title>
    @vite('resources/sass/email.scss')
</head>
<body class="email">
    <div class="container">
        @yield('content')
    </div>
</body>
</html>
