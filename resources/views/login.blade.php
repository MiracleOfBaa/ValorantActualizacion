<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>VALORANT</title>
    <link
      href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css"
      rel="stylesheet"
    />
    <link rel="icon" href="{{ asset('Fotos/descarga.jpeg') }}" type="image/x-icon" />
  </head>

  <body class="relative font-sans bg-black">
    @include('partials.navbar')
    <!-- Contenido de la página -->
    <div class="flex flex-col items-start justify-between pt-10 space-y-8 md:flex-row md:p-10 md:space-y-0 md:space-x-8">
      <!-- Columna del medio -->
      <div class="w-full pt-16 md:w-2/5">
        <h2 class="mb-8 text-5xl text-center text-white md:text-left">
          INICIAR SESIÓN
        </h2>
        <!-- Formulario en una tarjeta -->
        <form action="{{ route('login') }}" method="POST" class="flex flex-col pt-8 mb-10 rounded shadow-lg md:mb-8">
          @csrf
          <input
            id="username"
            name="username"
            type="text"
            placeholder="Nombre de usuario"
            class="w-full p-3 mb-5 border-2 border-white rounded-md focus:border-blue-500 focus:outline-none"
          />
          @error('username')
          <div class="text-red-500">{{ $message }}</div>
          @enderror

          <input
            id="password"
            name="password"
            type="password"
            placeholder="Contraseña"
            class="w-full p-3 mb-5 border-2 border-white rounded-md focus:border-blue-500 focus:outline-none"
          />
          @error('password')
          <div class="text-red-500">{{ $message }}</div>
          @enderror

          <button
            type="submit"
            class="w-full p-3 m-auto mt-5 font-bold text-white transition bg-blue-500 rounded-md hover:bg-blue-300"
          >
            Iniciar Sesión
          </button>
        </form>

        <!-- Tres Imágenes en tarjetas cuadradas (debajo del formulario y ordenadas horizontalmente) -->
        <div class="flex flex-col w-full pt-6 space-y-5 md:flex-row md:space-x-5">
          <img
            src="{{ asset('Fotos/fotosContacto/tarjeta3.jpeg') }}"
            alt="Imagen 2"
            class="object-cover w-full h-40 md:w-1/3"
          />
          <img
            src="{{ asset('Fotos/fotosContacto/tarjeta4.png') }}"
            alt="Imagen 3"
            class="object-cover w-full h-40 md:w-1/3"
          />
          <img
            src="{{ asset('Fotos/fotosContacto/tarjeta5.png') }}"
            alt="Imagen 4"
            class="object-cover w-full h-40 md:w-1/3"
          />
        </div>
      </div>

      <!-- Columna derecha -->
      <div class="w-full md:w-1/5">
        <img
          src="{{ asset('Fotos/fotosContacto/tarjeta2.webp') }}"
          alt="Imagen 5"
          class="object-cover w-full h-40 mb-5 border-4 border-black md:h-auto md:mb-0"
        />
      </div>
    </div>

    <script src="{{ asset('src/utils.js') }}"></script>
    <!-- Ya no necesitas el script del login JS porque usaremos un formulario tradicional con Laravel -->
  </body>
</html>
