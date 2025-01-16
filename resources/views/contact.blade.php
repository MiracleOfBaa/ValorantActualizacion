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

  <body class="font-sans relative bg-black">
    @include('partials.navbar')

    <!-- Contenido de la página -->
    <div class="flex flex-col md:flex-row justify-between items-start pt-10 md:p-10 space-y-8 md:space-y-0 md:space-x-8">

      <!-- Columna izquierda -->
      <div class="w-full md:w-1/5">
        <img
          src="{{ asset('Fotos/fotosContacto/tarjeta1.webp') }}"
          alt="Imagen 1"
          class="w-full h-40 md:h-auto object-cover border-4 border-black mb-5 md:mb-0"
        />
      </div>

      <!-- Columna del medio -->
      <div class="w-full md:w-2/5 pt-16">
        <h2 class="text-5xl text-white mb-8 text-center md:text-left">
          CONTÁCTANOS
        </h2>

        <!-- Mensaje de éxito (mostrado encima del formulario) -->
        <div class="w-full">
          @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded-md mb-4 w-full">
              {{ session('success') }}
            </div>
          @endif

          <!-- Mensajes de error (validación) -->
          @if ($errors->any())
            <div class="bg-red-500 text-white p-4 rounded-md mb-4 w-full">
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif
        </div>

        <!-- Formulario en una tarjeta -->
        <div class="pt-8 rounded shadow-lg mb-10 md:mb-8 flex flex-col">
          <!-- Formulario -->
          <form action="{{ route('contact.store') }}" method="POST">
            @csrf
            <input
              type="text"
              name="name"
              placeholder="Nombre"
              class="p-3 mb-5 w-full rounded-md border-2 border-white focus:border-blue-500 focus:outline-none"
            />
            <input
              type="email"
              name="email"
              placeholder="Email"
              class="p-3 mb-5 w-full rounded-md border-2 border-white focus:border-blue-500 focus:outline-none"
            />
            <textarea
              name="message"
              placeholder="Mensaje"
              class="p-3 w-full h-40 rounded-md border-2 border-white focus:border-blue-500 focus:outline-none"
            ></textarea>
            <button
              type="submit"
              class="bg-black text-white p-3 mt-5 w-full font-bold rounded-md bg-blue-500 m-auto hover:bg-blue-300 transition"
            >
              Enviar
            </button>
          </form>
        </div>

        <!-- Tres Imágenes en tarjetas cuadradas -->
        <div class="flex flex-col md:flex-row w-full space-y-5 md:space-x-5 pt-6">
          <img
            src="{{ asset('Fotos/fotosContacto/tarjeta3.jpeg') }}"
            alt="Imagen 2"
            class="w-full md:w-1/3 h-40 object-cover"
          />
          <img
            src="{{ asset('Fotos/fotosContacto/tarjeta4.png') }}"
            alt="Imagen 3"
            class="w-full md:w-1/3 h-40 object-cover"
          />
          <img
            src="{{ asset('Fotos/fotosContacto/tarjeta5.png') }}"
            alt="Imagen 4"
            class="w-full md:w-1/3 h-40 object-cover"
          />
        </div>
      </div>

      <!-- Columna derecha -->
      <div class="w-full md:w-1/5">
        <img
          src="{{ asset('Fotos/fotosContacto/tarjeta2.webp') }}"
          alt="Imagen 5"
          class="w-full h-40 md:h-auto object-cover border-4 border-black mb-5 md:mb-0"
        />
      </div>
    </div>

    <script src="{{ asset('src/utils.js') }}"></script>
  </body>
</html>
