<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>VALORANT</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <link rel="icon" href="{{ asset('Fotos/descarga.jpeg') }}" type="image/x-icon" />
    <style>
      .form {
        clip-path: polygon(
          20% 0%,
          80% 0%,
          100% 20%,
          100% 80%,
          80% 100%,
          20% 100%,
          0% 80%,
          0% 20%
        );
        display: flex;
        justify-content: center;
        align-items: center;
      }

      .form-content {
        text-align: center;
      }
    </style>
  </head>
  <body class="font-sans relative bg-black bg-cover Fotos">
    @include('partials.navbar')
    <div id="filters" class="flex justify-center items-center space-x-4 mb-6 mt-6">
      <!-- Search bar -->
      <input
        type="text"
        placeholder="Search by agent name"
        class="px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
        id="searchAgent"
      />

      <!-- Select dropdown -->
      <select
        id="filterBy"
        class="px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
      >
        <option selected value="">All Agents</option>
        <option value="liked">Liked Agents</option>
        <option value="centinela">Type: Centinela</option>
        <option value="controlador">Type: Controlador</option>
        <option value="duelista">Type: Duelista</option>
        <option value="iniciador">Type: Iniciador</option>
      </select>
    </div>

    <div id="agents" class="container mx-auto my-8 flex flex-wrap justify-center gap-8">
      <!-- Aquí se mostrarán los agentes -->
      @foreach($agents as $agent)
        <div class="agent-card bg-gray-800 text-white rounded-lg p-4 w-64">
          <img src="{{ asset('storage/' . $agent->photo) }}" alt="{{ $agent->name }}" class="w-full h-32 object-cover rounded-lg mb-4">
          <h3 class="text-xl mb-2">{{ $agent->name }}</h3>
          <p class="text-sm">{{ Str::limit($agent->description, 100) }}</p>
          <div class="mt-4 flex justify-between items-center">
            <a href="{{ route('agents.show', $agent->id) }}" class="text-blue-500 hover:underline">View Details</a>
            <a href="{{ route('agents.edit', $agent->id) }}" class="text-yellow-500 hover:underline">Edit</a>
          </div>
        </div>
      @endforeach
    </div>

    <script src="{{ asset('src/utils.js') }}"></script>
    <script src="{{ asset('src/pages/AgentsPage.js') }}"></script>
  </body>
</html>
