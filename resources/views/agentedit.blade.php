<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'VALORANT' }}</title>
    <link
        href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css"
        rel="stylesheet"
    />
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    />
    <link rel="icon" href="{{ asset('Fotos/descarga.jpeg') }}" type="image/x-icon">
</head>
<body class="font-sans relative bg-black bg-cover Fotos">
    @include('partials.navbar')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl text-center mb-6 text-gray-200">Create Agent</h1>
        <form id="createForm" class="max-w-lg mx-auto" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" id="agentId" name="agentId" value="{{ old('agentId') }}" />
            <div class="mb-4">
                <label for="type" class="block mb-1 text-gray-200">Agent Type</label>
                <select
                    id="type"
                    name="type"
                    class="w-full p-2 border border-white rounded bg-black text-white"
                >
                    <option value="centinela" {{ old('type') == 'centinela' ? 'selected' : '' }}>Centinela</option>
                    <option value="controlador" {{ old('type') == 'controlador' ? 'selected' : '' }}>Controlador</option>
                    <option value="duelista" {{ old('type') == 'duelista' ? 'selected' : '' }}>Duelista</option>
                    <option value="iniciador" {{ old('type') == 'iniciador' ? 'selected' : '' }}>Iniciador</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="name" class="block mb-1 text-gray-200">Agent Name</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    class="w-full p-2 border border-white rounded bg-black text-white"
                    value="{{ old('name') }}"
                />
            </div>
            <div class="mb-4">
                <label for="description" class="block mb-1 text-gray-200">Agent Description</label>
                <textarea
                    id="description"
                    name="description"
                    class="w-full p-2 border border-white rounded bg-black text-white"
                >{{ old('description') }}</textarea>
            </div>
            <div class="mb-4">
                <label for="photo" class="block mb-1 text-gray-200">Agent Photo</label>
                <input
                    type="file"
                    id="photo"
                    name="photo"
                    accept="image/*"
                    class="w-full bg-black text-white"
                />
            </div>
            <div class="mb-4">
                <label for="wallpaper" class="block mb-1 text-gray-200">Agent Wallpaper</label>
                <input
                    type="file"
                    id="wallpaper"
                    name="wallpaper"
                    accept="image/*"
                    class="w-full bg-black text-white"
                />
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                @foreach (['q', 'e', 'c', 'x'] as $section)
                    <div class="section">
                        <h2 class="text-xl mb-2 text-gray-200">{{ strtoupper($section) }} Section</h2>
                        <div class="mb-2">
                            <label for="{{ $section }}_header" class="block mb-1 text-gray-200">{{ strtoupper($section) }} Header</label>
                            <input
                                type="text"
                                id="{{ $section }}_header"
                                name="{{ $section }}_header"
                                class="w-full p-2 border border-white rounded bg-black text-white"
                                value="{{ old("{$section}_header") }}"
                            />
                        </div>
                        <div class="mb-2">
                            <label for="{{ $section }}_body" class="block mb-1 text-gray-200">{{ strtoupper($section) }} Body</label>
                            <textarea
                                id="{{ $section }}_body"
                                name="{{ $section }}_body"
                                class="w-full p-2 border border-white rounded bg-black text-white"
                            >{{ old("{$section}_body") }}</textarea>
                        </div>
                        <div>
                            <label for="{{ $section }}_video" class="block mb-1 text-gray-200">{{ strtoupper($section) }} Video</label>
                            <input
                                type="file"
                                id="{{ $section }}_video"
                                name="{{ $section }}_video"
                                accept="video/*"
                                class="w-full bg-black text-white"
                            />
                        </div>
                    </div>
                @endforeach
            </div>
            <button
                type="submit"
                class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600"
            >
                <i class="fa fa-plus mr-1"></i>
                Update Agent
            </button>
        </form>
    </div>
    <script src="{{ asset('src/utils.js') }}"></script>
    <script src="{{ asset('src/pages/AgentEdit.js') }}"></script>
</body>
</html>
