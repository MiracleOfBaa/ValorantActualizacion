<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Administración de Usuarios - VALORANT</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
</head>

<body class="min-h-screen bg-black">
    @include('partials.navbar')

    <h1 class="mb-4 text-2xl font-bold text-white">Editar Usuario</h1>
    <form action="{{ route('admin.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="username" class="block text-white">Nombre de Usuario</label>
            <input type="text" id="username" name="username" value="{{ old('username', $user->username) }}" class="w-full p-2 rounded form-control" required>
        </div>

        <!-- Puedes agregar más campos, por ejemplo para password y role, si es necesario -->
        <div class="mb-4">
            <label for="password" class="block text-white">Contraseña</label>
            <input type="password" id="password" name="password" class="w-full p-2 rounded form-control">
        </div>

        <div class="mb-4">
            <label for="role" class="block text-white">Rol</label>
            <select id="role" name="role" class="w-full p-2 rounded form-control">
                <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>Usuario</option>
                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Administrador</option>
            </select>
        </div>

        <button type="submit" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
            Actualizar
        </button>
    </form>

</body>
</html>
