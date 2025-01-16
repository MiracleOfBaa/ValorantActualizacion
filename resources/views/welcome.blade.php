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
  <body class="relative font-sans bg-black bg-center bg-cover">
    @include('partials.navbar')
    <video
      class="fixed top-0 left-0 z-0 object-cover w-full h-full min-w-full min-h-full"
      autoplay
      loop
      muted
    >
      <source src="{{ asset('Fotos/ssstwitter.com_1704817814502.mp4') }}" type="video/mp4" />
      Tu navegador no soporta el elemento de video.
    </video>

    <!-- Contenido de la página -->
    <div class="flex-grow"></div>
    <!-- Este div ocupa el espacio restante entre el contenido y el footer -->

    <!-- <script src="{{ asset('src/utils.js') }}"></script> -->
  </body>
</html>
