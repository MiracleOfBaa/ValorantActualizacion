<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="{{ asset('Fotos/descarga.jpeg') }}" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Agent Page' }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" />
</head>
<body class="relative font-sans bg-black bg-center bg-cover">
    @include('partials.navbar')

    <div class="relative flex items-center h-screen">
        <!-- Imagen a la izquierda -->
        <div class="absolute top-0 left-0 w-1/5 h-full bg-black">
            <img
                id="imagen"
                src="{{ asset('Fotos/' . $agent->photo) }}" <!-- Imagen del agente -->
                alt="{{ $agent->name }}"
                class="object-contain w-full h-full"
            />
        </div>

        <!-- Fondo con imagen y sombra -->
        <img
            id="wallpaper"
            src="{{ asset('Fotos/FondosPantallaAgentes/' . $agent->background) }}"  <!-- Ruta correcta -->
            alt="Fondo de la página"
            class="absolute top-0 right-0 object-cover w-4/5 h-full"
        />

        <div class="absolute top-0 right-0 w-4/5 h-full p-2 text-center text-white bg-gray-800 rounded-md bg-opacity-70 md:p-4">
            <div class="mt-8 mb-2 md:mb-4">
                <h1 id="nombre" class="font-bold text-yellow-300 md:text-8xl">{{ $agent->name }}</h1>
            </div>

            <div class="mt-16 mb-2 md:mb-8">
                <p id="descripcion">{{ $agent->description }}</p> <!-- Descripción del agente -->
            </div>

            <!-- Cuatro tarjetas con información y video en 2 columnas verticales -->
            <div class="grid grid-cols-1 mt-24 md:grid-cols-2 md:gap-4">
                @for ($i = 0; $i < count($agent->abilities); $i++)
                    <div class="flex flex-col items-center justify-center gap-4 p-2 text-center bg-black bg-opacity-75 rounded-md aspect-w-16 aspect-h-9 md:flex-row">
                        <p id="qBody" class="text-sm md:text-lg">
                            <span id="qHeader" class="font-bold text-yellow-300">{{ $agent->abilities[$i]->header }}</span>
                            <br />
                            {{ $agent->abilities[$i]->body }}
                        </p>
                        <iframe
                            id="qVideo"
                            class="md:w-[75%] md:h-[75%] w-full h-full rounded-md"
                            src="{{ asset('Fotos/videos/' . $agent->abilities[$i]->video) }}" <!-- Video de la habilidad Q -->
                            frameborder="0"
                            allowfullscreen
                            autoplay
                            loop
                            muted
                        ></iframe>
                    </div>
                @endfor
            </div>

            <!-- Sección de comentarios -->
            <div class="mt-16 mb-8">
                <h2 class="text-3xl font-semibold text-white">Comentarios</h2>
                <!-- Formulario para agregar un nuevo comentario -->
                <div class="mt-4">
                    <form action="{{ route('comments.store', $agent->id) }}" method="POST" class="flex flex-col gap-4">
                        @csrf
                        <textarea name="comment" rows="4" placeholder="Escribe tu comentario..." class="px-4 py-2 text-white bg-gray-800 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
                        <button type="submit" class="px-4 py-2 text-white bg-blue-500 rounded-md hover:bg-blue-600">Enviar comentario</button>
                    </form>
                </div>

                <!-- Lista de comentarios -->
                <div class="mt-8 space-y-4">
                    @foreach ($agent->comments as $comment)
                        <div class="p-4 bg-gray-800 rounded-md">
                            <div class="flex justify-between">
                                <span class="text-yellow-300">{{ $comment->user->name }}</span>
                                <div class="flex items-center gap-2">
                                    <!-- Botón de like -->
                                    <form action="{{ route('comments.like', $comment->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="text-gray-300 hover:text-yellow-300">
                                            <i class="fas fa-thumbs-up"></i> {{ $comment->likes_count }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <p class="mt-2 text-white">{{ $comment->content }}</p>

                            <!-- Respuestas -->
                            <div class="pl-6 mt-4 space-y-4">
                                @foreach ($comment->replies as $reply)
                                    <div class="p-4 bg-gray-700 rounded-md">
                                        <div class="flex justify-between">
                                            <span class="text-yellow-300">{{ $reply->user->name }}</span>
                                        </div>
                                        <p class="mt-2 text-white">{{ $reply->content }}</p>
                                    </div>
                                @endforeach

                                <!-- Formulario para responder -->
                                <div class="mt-4">
                                    <form action="{{ route('comments.reply', $comment->id) }}" method="POST" class="flex flex-col gap-4">
                                        @csrf
                                        <textarea name="reply" rows="2" placeholder="Responde a este comentario..." class="px-4 py-2 text-white bg-gray-700 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                                        <button type="submit" class="px-4 py-2 text-white bg-blue-500 rounded-md hover:bg-blue-600">Responder</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('src/utils.js') }}"></script>
    <script src="{{ asset('src/pages/AgentPage.js') }}"></script>
</body>
</html>
