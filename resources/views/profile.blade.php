<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Perfil de Usuario - VALORANT</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
  </head>

  <body class="bg-black min-h-screen">
    @include('partials.navbar')

    <!-- Contenido Principal -->
    <div class="container mx-auto mt-12 flex justify-center items-center px-4">
      <!-- Tarjeta para mostrar y editar perfil -->
      <div class="card p-8 rounded-lg w-full max-w-lg border border-gray-700">
        <h2 class="text-2xl font-bold text-gray-100 mb-6 text-center">
          Editar Perfil
        </h2>

        <!-- Mostrar los datos actuales del usuario -->
        <div class="mb-6 text-center">
          <p class="text-gray-300">Nombre de Usuario: <span class="font-semibold">{{ auth()->user()->username }}</span></p>
        </div>

        <!-- Si hay un mensaje de éxito, lo mostramos -->
        @if(session('success'))
          <div class="mb-4 text-green-500 text-center">
            {{ session('success') }}
          </div>
        @endif

        <!-- Formulario para editar el perfil -->
        <form action="{{ route('profile.update') }}" method="POST" class="space-y-5">
          @csrf

          <!-- Nombre de Usuario -->
          <div>
            <label for="username" class="block text-gray-300 text-sm mb-2">Nombre de Usuario:</label>
            <input
              type="text"
              id="username"
              name="username"
              value="{{ auth()->user()->username }}" <!-- Mostrar el nombre de usuario actual -->
              class="w-full px-4 py-2 bg-gray-800 text-gray-300 rounded-md border border-gray-600 focus:ring-2 focus:ring-blue-500"
              placeholder="Ingresa tu nombre de usuario"
              required
            />
            @error('username')
              <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror
          </div>

          <!-- Contraseña -->
          <div>
            <label for="password" class="block text-gray-300 text-sm mb-2">Contraseña:</label>
            <input
              type="password"
              id="password"
              name="password"
              class="w-full px-4 py-2 bg-gray-800 text-gray-300 rounded-md border border-gray-600 focus:ring-2 focus:ring-blue-500"
              placeholder="Deja en blanco para no cambiar"
            />
            @error('password')
              <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror
          </div>

          <!-- Confirmar Contraseña -->
          <div>
            <label for="password_confirmation" class="block text-gray-300 text-sm mb-2">Confirmar Contraseña:</label>
            <input
              type="password"
              id="password_confirmation"
              name="password_confirmation"
              class="w-full px-4 py-2 bg-gray-800 text-gray-300 rounded-md border border-gray-600 focus:ring-2 focus:ring-blue-500"
              placeholder="Confirma tu nueva contraseña"
            />
          </div>

          <!-- Botón Guardar Cambios -->
          <button
            type="submit"
            class="w-full bg-blue-500 text-white font-semibold py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400"
          >
            Guardar Cambios
          </button>
        </form>
      </div>
    </div>
  </body>
</html>
