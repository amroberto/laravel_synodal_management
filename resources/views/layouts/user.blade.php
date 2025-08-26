<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestão Sinodal - @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('build/assets/app.css') }}">
    <!-- Adicione outros estilos, se necessário -->
</head>
<body>
    <header>
        <nav>
            <a href="{{ url('/') }}">Home</a>
            <a href="{{ route('user.dashboard') }}">Dashboard</a>
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit">Sair</button>
            </form>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <p>Gestão Sinodal &copy; {{ date('Y') }}</p>
    </footer>

    <script src="{{ asset('build/assets/app.js') }}"></script>
</body>
</html>
