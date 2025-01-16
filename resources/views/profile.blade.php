<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Perfil de Usuario - VALORANT</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
</head>

<body class="min-h-screen bg-black">
    @include('partials.navbar')

    <!-- Contenido Principal -->
    <div class="container flex items-center justify-center px-4 mx-auto mt-12">
        <!-- Tarjeta para mostrar y editar perfil -->
        <div class="w-full max-w-lg p-8 border border-gray-700 rounded-lg card">
            <h2 class="mb-6 text-2xl font-bold text-center text-gray-100">
                Editar Perfil
            </h2>

            <!-- Mostrar los datos actuales del usuario -->
            <div class="mb-6 text-center">
                <p class="text-gray-300">Nombre de Usuario: <span class="font-semibold">{{ $user->username }}</span></p>
            </div>

            <!-- Si hay un mensaje de éxito, lo mostramos -->
            @if(session('success'))
                <div class="mb-4 text-center text-green-500">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Formulario para editar el perfil -->
            <form action="{{ route('profile.update') }}" method="POST" class="space-y-5">
                @csrf

                <!-- Nombre de Usuario -->
                <div>
                    <label for="username" class="block mb-2 text-sm text-gray-300">Nombre de Usuario:</label>
                    <input
                        type="text"
                        id="username"
                        name="username"
                        value="{{ $user->username }}" <!-- Mostrar el nombre de usuario actual -->
                        class="w-full px-4 py-2 text-gray-300 bg-gray-800 border border-gray-600 rounded-md focus:ring-2 focus:ring-blue-500"
                        placeholder="Ingresa tu nombre de usuario"
                        required
                    />
                    @error('username')
                        <div class="text-sm text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Contraseña -->
                <div>
                    <label for="password" class="block mb-2 text-sm text-gray-300">Contraseña:</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="w-full px-4 py-2 text-gray-300 bg-gray-800 border border-gray-600 rounded-md focus:ring-2 focus:ring-blue-500"
                        placeholder="Deja en blanco para no cambiar"
                    />
                    @error('password')
                        <div class="text-sm text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Confirmar Contraseña -->
                <div>
                    <label for="password_confirmation" class="block mb-2 text-sm text-gray-300">Confirmar Contraseña:</label>
                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        class="w-full px-4 py-2 text-gray-300 bg-gray-800 border border-gray-600 rounded-md focus:ring-2 focus:ring-blue-500"
                        placeholder="Confirma tu nueva contraseña"
                    />
                </div>

                <!-- Botón Guardar Cambios -->
                <button
                    type="submit"
                    class="w-full px-4 py-2 font-semibold text-white bg-blue-500 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400"
                >
                    Guardar Cambios
                </button>
            </form>
        </div>
    </div>
</body>
</html>
