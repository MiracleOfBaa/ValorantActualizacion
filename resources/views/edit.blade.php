<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Agent</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
</head>
<body class="bg-black text-white">

    @include('partials.navbar')

    <!-- Edit Agent Form -->
    <div class="max-w-4xl mx-auto mt-12 px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-bold text-center text-white mb-8">Edit Agent: {{ $agent->name }}</h1>

        <form action="{{ route('agents.update', $agent->id) }}" method="POST" enctype="multipart/form-data" class="bg-gray-800 p-8 rounded-lg shadow-lg space-y-6">
            @csrf
            @method('PUT') <!-- Método PUT para la actualización -->

            <!-- Agent Name -->
            <div class="mb-6">
                <label for="name" class="block text-gray-300 text-lg font-medium">Agent Name</label>
                <input type="text" name="name" id="name" value="{{ $agent->name }}" class="w-full px-4 py-3 text-gray-300 border border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- Agent Photo -->
            <div class="mb-6">
                <label for="photo" class="block text-gray-300 text-lg font-medium">Agent Photo</label>
                <input type="file" name="photo" id="photo" class="w-full px-4 py-3 text-gray-300 border border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                <div class="mt-4">
                    <img src="{{ asset('Fotos/' . $agent->photo) }}" alt="Agent Image" class="w-32 h-32 object-cover rounded-md mx-auto shadow-lg">
                </div>
            </div>

            <!-- Update Button -->
            <div class="text-center">
                <button type="submit" class="w-full py-3 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 transition duration-300">Update Agent</button>
            </div>
        </form>
    </div>
</body>
</html>
