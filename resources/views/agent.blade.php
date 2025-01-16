<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="{{ asset('Fotos/descarga.jpeg') }}" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Agent Page' }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" />
    <style>
        .like-button {
            cursor: pointer;
            transition: color 0.3s;
        }
        .liked {
            color: red;
        }
        .comment {
            background-color: rgba(0, 0, 0, 0.5);
            border-radius: 8px;
            padding: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        }
        .comment-header {
            color: #FFDD57;
            font-weight: bold;
        }
        .comment-body {
            color: #f2f2f2;
        }
        .reply-button {
            background-color: #ff914d;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .reply-button:hover {
            background-color: #ff7f32;
        }
        .response-area {
            background-color: #333;
            padding: 12px;
            border-radius: 8px;
            margin-top: 16px;
            display: none;
        }
        .response-area textarea {
            width: 100%;
            padding: 8px;
            border-radius: 6px;
            border: 1px solid #555;
            background-color: #444;
            color: #ddd;
        }
        .response-area button {
            background-color: #008CBA;
            color: white;
            padding: 8px 16px;
            border-radius: 4px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .response-area button:hover {
            background-color: #006f8e;
        }
    </style>
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

        <div class="absolute top-0 right-0 w-4/5 h-full p-4 text-center text-white bg-gray-800 rounded-md bg-opacity-70 md:p-8">
            <div class="mt-8 mb-2 md:mb-4">
                <h1 id="nombre" class="font-bold text-yellow-300 md:text-8xl">{{ $agent->name }}</h1>
            </div>

            <div class="mt-16 mb-2 md:mb-8">
                <p id="descripcion">{{ $agent->description }}</p> <!-- Descripción del agente -->
            </div>

            <!-- Cuatro tarjetas con información y video en 2 columnas verticales -->
            <div class="grid grid-cols-1 mt-24 md:grid-cols-2 md:gap-4">
                @for ($i = 0; $i < count($agent->abilities); $i++)
                    <div class="flex flex-col items-center justify-center gap-4 p-4 text-center bg-black bg-opacity-75 rounded-md aspect-w-16 aspect-h-9 md:flex-row">
                        <p id="qBody" class="text-sm md:text-lg">
                            <span id="qHeader" class="font-bold text-yellow-300">{{ $agent->abilities[$i]->header }}</span>
                            <br />
                            {{ $agent->abilities[$i]->body }}
                        </p>
                        <iframe
                            id="qVideo"
                            class="md:w-[75%] md:h-[75%] w-full h-full rounded-md"
                            src="{{ asset('Fotos/' . $agent->abilities[$i]->video) }}" <!-- Video de la habilidad Q -->
                            frameborder="0"
                            allowfullscreen
                            autoplay
                            loop
                            muted
                        ></iframe>
                    </div>
                @endfor
            </div>

            <!-- Sección de comentarios (solo si el usuario está logueado) -->
            @if (auth()->id() !== null)
                <div class="mt-16 mb-8">
                    <h2 class="text-3xl font-semibold text-white">Comentarios</h2>
                    <!-- Formulario para agregar un nuevo comentario -->
                    <div class="mt-6">
                        <form action="{{ route('comments.store', $agent->id) }}" method="POST" class="flex flex-col gap-4">
                            @csrf
                            <textarea name="comment" rows="4" placeholder="Escribe tu comentario..." class="px-4 py-2 text-white bg-gray-800 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
                            <button type="submit" class="px-4 py-2 text-white bg-blue-500 rounded-md hover:bg-blue-600">Enviar comentario</button>
                        </form>
                    </div>

                    <!-- Lista de comentarios -->
                    <div class="mt-8 space-y-6">
                        @foreach ($agent->comments as $comment)
                            <div class="comment">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <span class="comment-header">{{ $comment->user->username }}</span>
                                    </div>
                                    <div class="flex items-center gap-4">
                                        <!-- Corazón de like -->
                                        <form action="{{ route('comments.like', $comment->id) }}" method="POST" class="like-form">
                                            @csrf
                                            <button type="submit" class="text-gray-300 like-button hover:text-yellow-300">
                                                @if($agent->isLikedByUser(auth()->id()))
                                                    <i class="text-red-500 fas fa-heart"></i> <!-- Mostrar el ícono de corazón si está "liked" -->
                                                @else
                                                    <i class="text-white far fa-heart"></i> <!-- Mostrar el ícono de corazón vacío si no está "liked" -->
                                                @endif

                                            </button>
                                        </form>
                                    </div>
                                </div>
                                <p class="mt-2 comment-body">{{ $comment->content }}</p>

                                <!-- Botón para responder -->
                                <div class="flex justify-end mt-2">
                                    <button
                                        class="reply-button"
                                        onclick="toggleReplyForm({{ $comment->id }})"
                                    >
                                        Responder
                                    </button>
                                </div>

                                <!-- Formulario para responder (oculto inicialmente) -->
                                <div id="reply-form-{{ $comment->id }}" class="response-area">
                                    <form action="{{ route('comments.reply', $comment->id) }}" method="POST" class="flex flex-col gap-4">
                                        @csrf
                                        <textarea name="reply" rows="2" placeholder="Escribe tu respuesta..." class="px-4 py-2 text-white bg-gray-700 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                                        <button type="submit" class="px-4 py-2 text-white bg-blue-500 rounded-md hover:bg-blue-600">Enviar respuesta</button>
                                    </form>
                                </div>

                                <!-- Respuestas -->
                                <div class="pl-6 mt-4 space-y-4">
                                    @foreach ($comment->replies as $reply)
                                        <div class="p-4 bg-gray-700 rounded-md">
                                            <span class="text-yellow-300">{{ $reply->user->name }}</span>
                                            <p class="mt-2 text-white">{{ $reply->content }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="p-4 mt-6 text-center bg-gray-800 rounded-md">
                    <p class="text-white">Para comentar, por favor <a href="{{ route('login') }}" class="text-yellow-300 hover:underline">inicia sesión</a>.</p>
                </div>
            @endif
        </div>
    </div>

    <script src="{{ asset('src/utils.js') }}"></script>
    <script src="{{ asset('src/pages/AgentPage.js') }}"></script>

    <script>
        // Función para alternar la visibilidad del formulario de respuesta
        function toggleReplyForm(commentId) {
            const replyForm = document.getElementById(`reply-form-${commentId}`);
            replyForm.classList.toggle('hidden');
        }
    </script>
</body>
</html>
