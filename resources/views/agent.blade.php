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
        <div class="absolute top-0 left-0 w-1/5 h-full bg-black">
            <img id="imagen" src="{{ asset('Fotos/' . $agent->photo) }}" alt="{{ $agent->name }}" class="object-contain w-full h-full" />
        </div>

        <img id="wallpaper" src="{{ asset('Fotos/' . $agent->wallpaper) }}" alt="Fondo de la página" class="absolute top-0 right-0 object-cover w-4/5 h-full" />

        <div class="absolute top-0 right-0 w-4/5 h-full p-4 text-center text-white bg-gray-800 rounded-md bg-opacity-70 md:p-8">
            <div class="mb-2 md:mb-4">
                <h1 id="nombre" class="font-bold text-yellow-300 md:text-8xl">{{ $agent->name }}</h1>
            </div>

            <div class="mt-16 mb-2 md:mb-8">
                <p id="descripcion">{{ $agent->description }}</p>
            </div>

            <div class="grid grid-cols-1 mt-8 md:grid-cols-2 md:gap-4">
                @for ($i = 0; $i < count($agent->abilities); $i++)
                    <div class="flex flex-col items-center justify-center gap-4 p-4 text-center bg-black bg-opacity-75 rounded-md aspect-w-16 aspect-h-9 md:flex-row">
                        <p id="qBody" class="text-sm md:text-lg">
                            <span id="qHeader" class="font-bold text-yellow-300">{{ $agent->abilities[$i]->header }}</span>
                            <br />
                            {{ $agent->abilities[$i]->body }}
                        </p>
                        <iframe id="qVideo" class="md:w-[75%] md:h-[75%] w-full h-full rounded-md" src="{{ asset('Fotos/' . $agent->abilities[$i]->video) }}" frameborder="0" allowfullscreen autoplay loop muted></iframe>
                    </div>
                @endfor
            </div>
    </div>
    </div>
    <div class="mt-16 mb-8">
    <h2 class="text-3xl font-semibold text-center text-white">Comentarios</h2>

    @if (auth()->id() !== null)
    <div class="mt-6">
    <form action="{{ route('comments.store', $agent->id) }}" method="POST" class="flex flex-col max-w-3xl gap-4 mx-auto">
        @csrf
        <textarea name="comment" rows="4" placeholder="Escribe tu comentario..." class="w-full px-4 py-2 text-white bg-gray-800 rounded-md resize-none focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
        <button type="submit" class="px-4 py-2 text-white bg-blue-500 rounded-md hover:bg-blue-600">Enviar comentario</button>
    </form>
</div>

    @endif

    <div class="mt-8 space-y-6">
        @foreach ($agent->comments as $comment)
            <div class="flex items-start max-w-4xl gap-4 p-4 mx-auto bg-gray-900 rounded-lg shadow-md">
                <div class="flex items-center justify-center w-12 h-12 bg-gray-700 rounded-full">
                    <span class="text-xl text-white">{{ strtoupper(substr($comment->user->username, 0, 1)) }}</span>
                </div>
                <div class="flex-1">
                    <div class="flex items-center justify-between">
                        <span class="font-semibold text-white">{{ $comment->user->username }}</span>
                        <span class="text-sm text-gray-400">{{ $comment->created_at->diffForHumans() }}</span>
                    </div>

                    <p class="mt-1 text-gray-300">{{ $comment->content }}</p>

                    @if (auth()->id() !== null)
                        <div class="mt-2">
                            <button class="text-sm text-blue-400 hover:text-blue-500" onclick="toggleReplyForm({{ $comment->id }})">
                                Responder
                            </button>
                        </div>
                    @endif

                    @if (auth()->id() !== null)
                        <div id="reply-form-{{ $comment->id }}" class="hidden mt-2">
                            <form action="{{ route('comments.reply', $comment->id) }}" method="POST" class="flex flex-col gap-2">
                                @csrf
                                <textarea name="reply" rows="2" placeholder="Escribe tu respuesta..." class="px-4 py-2 text-white bg-gray-800 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                                <button type="submit" class="px-4 py-2 text-white bg-blue-500 rounded-md hover:bg-blue-600">Enviar respuesta</button>
                            </form>
                        </div>
                    @endif

                    <div class="pl-6 mt-4 space-y-4 border-l-2 border-gray-700">
                        @foreach ($comment->replies as $reply)
                            <div class="flex items-start gap-3">
                                <div class="flex items-center justify-center w-8 h-8 bg-gray-700 rounded-full">
                                    <span class="text-lg text-white">{{ strtoupper(substr($reply->user->username, 0, 1)) }}</span>
                                </div>
                                <div class="flex-1">
                                    <span class="font-semibold text-white">{{ $reply->user->username }}</span>
                                    <span class="text-sm text-gray-400"> · {{ $reply->created_at->diffForHumans() }}</span>
                                    <p class="mt-1 text-gray-300">{{ $reply->content }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

    @if (!auth()->check())
        <div class="p-4 mt-6 text-center bg-gray-800 rounded-md">
            <p class="text-white">Para responder a los comentarios, por favor <a href="{{ route('login') }}" class="text-yellow-300 hover:underline">inicia sesión</a>.</p>
        </div>
    @endif

    <script>
        function toggleReplyForm(commentId) {
            const replyForm = document.getElementById(`reply-form-${commentId}`);
            replyForm.classList.toggle('hidden');
        }
    </script>
</body>
</html>
