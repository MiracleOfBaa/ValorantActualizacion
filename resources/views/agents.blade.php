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
        width: 240px; /* Ajuste del tamaño del agente */
        margin-bottom: 20px;
      }

      .agent-card:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      }

      .agent-img {
        width: 100%;
        height: 150px; /* Ajustar altura */
        object-fit: contain;  /* Asegura que la imagen se vea completa */
        object-position: center; /* Centra la imagen dentro del contenedor */
      }

      .heart {
        color: #e25555;
        cursor: pointer;
        font-size: 24px;
        transition: color 0.2s ease;
        margin-left: 10px;
      }

      .liked {
        color: #ff4d4d;
      }

      .agent-name-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
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

    <!-- Botón Añadir Agente (solo visible para admin) -->
    @if(auth()->user() && auth()->user()->role == 'admin')
      <div class="flex justify-center mb-6">
        <a href="{{ route('agents.create') }}" class="px-4 py-2 text-center text-white bg-green-500 rounded-md hover:bg-green-600">
          Add New Agent
        </a>
      </div>
    @endif

    <div id="agents" class="container flex flex-wrap justify-center gap-8 mx-auto my-8">
      <!-- Aquí se mostrarán los agentes -->
      @foreach($agents as $agent)
        <div class="flex flex-col items-center w-56 p-4 text-white bg-gray-800 rounded-lg agent-card">
          <a href="{{ route('agents.show', $agent->id) }}" class="block w-full">
            <img src="{{ asset('Fotos/' . $agent->photo) }}" alt="{{ $agent->name }}" class="mb-4 rounded-lg agent-img">
            <div class="agent-name-container">
              <h3 class="mb-2 text-xl">{{ $agent->name }}</h3>

              <!-- Corazón (like) al lado del nombre -->
              @if(auth()->check())
                <form action="{{ route('agents.like', $agent->id) }}" method="POST" class="inline">
                  @csrf
                  <button type="submit" class="heart {{ \App\Models\UserLikes::hasUserLikedAgent(auth()->id(), $agent->id) ? 'liked' : '' }}">
                        @if($agent->isLikedByUser(auth()->id()))
                            <i class="text-red-500 fas fa-heart"></i> <!-- Mostrar el ícono de corazón si está "liked" -->
                        @else
                            <i class="text-white far fa-heart"></i> <!-- Mostrar el ícono de corazón vacío si no está "liked" -->
                        @endif
                  </button>
                </form>
              @endif
            </div>
          </a>

          <!-- Botones Editar y Eliminar solo si el usuario es admin -->
            @if(auth()->check() && auth()->user()->role == 'admin')
            <div class="flex justify-between gap-4 mt-4">
              <!-- Botón de Editar -->
              <a href="{{ route('agents.edit', $agent->id) }}" class="px-4 py-2 text-center text-white bg-yellow-500 rounded-md hover:bg-yellow-600">
                Editar
              </a>

              <!-- Botón de Eliminar -->
              <form action="{{ route('agents.destroy', $agent->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este agente?')" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 text-center text-white bg-red-500 rounded-md hover:bg-red-600">
                  Eliminar
                </button>
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
