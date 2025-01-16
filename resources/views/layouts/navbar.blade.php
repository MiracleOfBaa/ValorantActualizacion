<nav class="bg-black bg-cover p-5 text-center relative z-10">
    <!-- Links comunes para todos -->
    <a href="{{ url('/about') }}" class="text-white mx-4 my-2 text-lg hover:text-gray-300 hover:bg-gray-700 transition rounded-full py-2 px-4">About</a>
    <a href="{{ url('/') }}" class="text-white mx-4 my-2 text-lg hover:text-gray-300 hover:bg-gray-700 transition rounded-full py-2 px-4">Home</a>
    <a href="{{ url('/agents') }}" class="text-white mx-4 my-2 text-lg hover:text-gray-300 hover:bg-gray-700 transition rounded-full py-2 px-4">Agents</a>
    <a href="{{ url('/contact') }}" class="text-white mx-4 my-2 text-lg hover:text-gray-300 hover:bg-gray-700 transition rounded-full py-2 px-4">Contact</a>
    <a href="{{ url('/news') }}" class="text-white mx-4 my-2 text-lg hover:text-gray-300 hover:bg-gray-700 transition rounded-full py-2 px-4">News</a>
    <a href="{{ url('/info') }}" class="text-white mx-4 my-2 text-lg hover:text-gray-300 hover:bg-gray-700 transition rounded-full py-2 px-4">Info</a>

    @guest
        <!-- Mostrar estas opciones si el usuario NO está autenticado -->
        <a href="{{ route('login') }}" class="text-white mx-4 my-2 text-lg hover:text-gray-300 hover:bg-gray-700 transition rounded-full py-2 px-4">Login</a>
        <a href="{{ route('register') }}" class="text-white mx-4 my-2 text-lg hover:text-gray-300 hover:bg-gray-700 transition rounded-full py-2 px-4">Register</a>
    @else
        <!-- Mostrar estas opciones si el usuario está autenticado -->
        @if (auth()->user()->role === 'admin')
            <a href="{{ url('/result') }}" class="text-white mx-4 my-2 text-lg hover:text-gray-300 hover:bg-gray-700 transition rounded-full py-2 px-4">Result</a>
        @endif
        <a href="{{ url('/profile') }}" class="text-white mx-4 my-2 text-lg hover:text-gray-300 hover:bg-gray-700 transition rounded-full py-2 px-4">Profile</a>
        <a href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
           class="text-white mx-4 my-2 text-lg hover:text-gray-300 hover:bg-gray-700 transition rounded-full py-2 px-4">Logout</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    @endguest
</nav>
