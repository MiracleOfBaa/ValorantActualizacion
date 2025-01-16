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

      <!-- Columna izquierda -->
      <div class="w-full md:w-1/5">
        <img
          src="{{ asset('Fotos/fotosContacto/tarjeta1.webp') }}"
          alt="Imagen 1"
          class="object-cover w-full h-40 mb-5 border-4 border-black md:h-auto md:mb-0"
        />
      </div>

      <!-- Columna del medio -->
      <div class="w-full pt-16 md:w-2/5">
        <h2 class="mb-8 text-5xl text-center text-white md:text-left">
          CONTÁCTANOS
        </h2>

        <!-- Mensaje de éxito (mostrado encima del formulario) -->
        <div class="w-full">
          @if(session('success'))
            <div class="w-full p-4 mb-4 text-white bg-green-500 rounded-md">
              {{ session('success') }}
            </div>
          @endif

          <!-- Mensajes de error (validación) -->
          @if ($errors->any())
            <div class="w-full p-4 mb-4 text-white bg-red-500 rounded-md">
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif
        </div>

        <!-- Formulario en una tarjeta -->
        <div class="flex flex-col pt-8 mb-10 rounded shadow-lg md:mb-8">
          <!-- Formulario -->
          <form action="{{ route('contact.store') }}" method="POST">
            @csrf
            <input
              type="text"
              name="name"
              placeholder="Nombre"
              class="w-full p-3 mb-5 border-2 border-white rounded-md focus:border-blue-500 focus:outline-none"
            />
            <input
              type="email"
              name="email"
              placeholder="Email"
              class="w-full p-3 mb-5 border-2 border-white rounded-md focus:border-blue-500 focus:outline-none"
            />
            <textarea
              name="message"
              placeholder="Mensaje"
              class="w-full h-40 p-3 border-2 border-white rounded-md focus:border-blue-500 focus:outline-none"
            ></textarea>
            <button
              type="submit"
              class="w-full p-3 m-auto mt-5 font-bold text-white transition bg-blue-500 rounded-md hover:bg-blue-300"
            >
              Enviar
            </button>
          </form>
        </div>

        <!-- Tres Imágenes en tarjetas cuadradas -->
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
  </body>
</html>
