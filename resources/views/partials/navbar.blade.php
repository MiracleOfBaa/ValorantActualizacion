<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
</head>
<body>
    <!-- Navbar -->
    <nav class="relative z-10 p-5 text-center bg-black bg-cover">
        <a href="{{ url('/about') }}" class="mx-4 text-white">About</a>
        <a href="{{ url('/') }}" class="mx-4 text-white">Home</a>
        <a href="{{ url('/contact') }}" class="mx-4 text-white">Contact</a>
        <a href="{{ url('/agents') }}" class="mx-4 text-white">Agents</a>
        <a href="{{ url('/info') }}" class="mx-4 text-white">Info</a>
        <a href="{{ url('/news') }}" class="mx-4 text-white">News</a>


        @if (auth()->check())
            <!-- Mostrar estas opciones si estás logueado -->
            <a href="{{ url('/profile') }}" class="mx-4 text-white">Profile</a>
            <a href="{{ route('logout') }}" class="mx-4 text-white"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
               Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        @else
            <!-- Mostrar estas opciones si NO estás logueado -->
            <a href="{{ route('login') }}" class="mx-4 text-white">Login</a>
            <a href="{{ route('register') }}" class="mx-4 text-white">Register</a>
        @endif
    </nav>

    <!-- Contenido dinámico -->
    <div class="container p-5 mx-auto">
        @yield('content')
    </div>
</body>
</html>
