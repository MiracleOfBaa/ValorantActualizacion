<?php

$users = App\Models\User::all();

?>

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

    <!-- Contenido Principal -->
    <div class="container px-4 mx-auto mt-12">
        <h2 class="mb-6 text-3xl font-bold text-center text-gray-100">Administración de Usuarios</h2>

        <!-- Tabla de Usuarios -->
        <div class="overflow-x-auto">
            <table class="w-full text-left border border-gray-700">
                <thead class="bg-gray-800">
                    <tr>
                        <th class="px-4 py-2 text-gray-300">ID</th>
                        <th class="px-4 py-2 text-gray-300">Nombre de Usuario</th>
                        <th class="px-4 py-2 text-gray-300">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr class="border-t border-gray-700">
                            <td class="px-4 py-2 text-gray-300">{{ $user->id }}</td>
                            <td class="px-4 py-2 text-gray-300">{{ $user->username }}</td>
                            <td class="px-4 py-2">
                                <a href="{{ route('admin.edit', $user->id) }}" class="px-3 py-1 text-white bg-yellow-500 rounded hover:bg-yellow-600">Editar</a>
                                <form action="{{ route('admin.delete', $user->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-1 text-white bg-red-500 rounded hover:bg-red-600">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
