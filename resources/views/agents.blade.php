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

      .agent-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
      }

      .agent-card:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      }

      .agent-img {
        width: 100%;
        height: 200px;
        object-fit: contain;  /* Asegura que la imagen se vea completa */
        object-position: center; /* Centra la imagen dentro del contenedor */
      }
    </style>
  </head>
  <body class="relative font-sans bg-black bg-cover Fotos">
    @include('partials.navbar')

    <form method="GET" action="{{ route('agents.index') }}" class="flex items-center justify-center mt-6 mb-6 space-x-4">
      <input
        type="text"
        name="search"
        placeholder="Search by agent name"
        class="px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
        value="{{ request('search') }}"  <!-- Retener el valor de búsqueda -->
      />

      <select
        name="filterBy"
        class="px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
      >
        <option value="">All Agents</option>
        <option value="liked" {{ request('filterBy') == 'liked' ? 'selected' : '' }}>Liked Agents</option>
        <option value="centinela" {{ request('filterBy') == 'centinela' ? 'selected' : '' }}>Type: Centinela</option>
        <option value="controlador" {{ request('filterBy') == 'controlador' ? 'selected' : '' }}>Type: Controlador</option>
        <option value="duelista" {{ request('filterBy') == 'duelista' ? 'selected' : '' }}>Type: Duelista</option>
        <option value="iniciador" {{ request('filterBy') == 'iniciador' ? 'selected' : '' }}>Type: Iniciador</option>
      </select>

      <button type="submit" class="px-4 py-2 text-white bg-blue-500 rounded-md">Filter</button>
    </form>

    <div id="agents" class="container flex flex-wrap justify-center gap-8 mx-auto my-8">
      <!-- Aquí se mostrarán los agentes -->
      @foreach($agents as $agent)
        <div class="w-64 p-4 text-white bg-gray-800 rounded-lg agent-card">
          <a href="{{ route('agents.show', $agent->id) }}" class="block">
            <img src="{{ asset('Fotos/' . $agent->photo) }}" alt="{{ $agent->name }}" class="agent-img mb-4 rounded-lg">
            <h3 class="mb-2 text-xl">{{ $agent->name }}</h3>
          </a>

          <!-- Botones Editar y Eliminar solo si el usuario es admin -->
          @if(auth()->user() && auth()->user()->role == 'admin')
            <div class="mt-4 flex justify-between gap-4">
              <!-- Botón de Editar -->
              <a href="{{ route('agents.edit', $agent->id) }}" class="px-4 py-2 bg-yellow-500 text-white rounded-md text-center hover:bg-yellow-600">Edit</a>

              <!-- Botón de Eliminar -->
              <form action="{{ route('agents.destroy', $agent->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this agent?')" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-md text-center hover:bg-red-600">Delete</button>
              </form>
            </div>
          @endif
        </div>
      @endforeach
    </div>

    <script src="{{ asset('src/utils.js') }}"></script>
    <script src="{{ asset('src/pages/AgentsPage.js') }}"></script>
  </body>
</html>
