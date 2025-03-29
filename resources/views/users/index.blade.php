<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <ul>
        @forelse ($users as $user)
            <li>
                {{ $user->name->name }} - {{ $user->email }}
                <form action="{{ route('users.update', $user) }}" method="PUT">
                    @csrf
                    <button type="submit">Editar Usuario</button>
                </form>
                <form action="{{ route('users.destroy', $user) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Eliminar Usuario</button>
                </form>
            </li>
        @empty
            <li>No hay usuarios registrados.</li>
        @endforelse
        <form action="{{ route('users.create') }}" method="GET">
            @csrf
            <button type="submit">Crear Usuario</button>
        </form>
    </ul>
</body>
</html>