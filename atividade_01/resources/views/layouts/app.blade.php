<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
     

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @auth
                            <!-- Link para todos os usuários logados -->
                            <li class="nav-item">
                             @php
                                // Verifica se a rota existe
                                $hasBooksIndex = Route::has('books.index');
                            @endphp
                            @if($hasBooksIndex)
                                <a class="nav-link" href="{{ route('books.index') }}">
                                    <i class="bi bi-book"></i> Livros
                                </a>

                             @else
                                {{-- Fallback para home --}}
                                <a class="nav-link" href="{{ url('/') }}">
                                    <i class="bi bi-book"></i> Livros
                                </a>
                            @endif
                            </li>

                            <!-- Links apenas para Bibliotecário e Admin -->
                            @can('create', App\Models\Book::class)
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                        <i class="bi bi-plus-circle"></i> Novo Livro
                                    </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('books.create.id') }}">
                                            <i class="bi bi-123"></i> Por ID
                                        </a>
                                        <a class="dropdown-item" href="{{ route('books.create.select') }}">
                                            <i class="bi bi-menu-down"></i> Por Select
                                        </a>
                                    </div>
                                </li>

                                <!-- Gerenciamento de Autores, Editoras, Categorias -->
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                        <i class="bi bi-gear"></i> Gerenciar
                                    </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('authors.index') }}">
                                            <i class="bi bi-person"></i> Autores
                                        </a>
                                        <a class="dropdown-item" href="{{ route('publishers.index') }}">
                                            <i class="bi bi-building"></i> Editoras
                                        </a>
                                        <a class="dropdown-item" href="{{ route('categories.index') }}">
                                            <i class="bi bi-tags"></i> Categorias
                                        </a>
                                    </div>
                                </li>

                                <!-- Empréstimos para bibliotecários -->
                               
                            @endcan

                             <!-- Links apenas para Admin -->
                            @can('viewAny', App\Models\User::class)
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('users.index') }}">
                                        <i class="bi bi-people"></i> Usuários
                                    </a>
                                </li>
                            @endcan
                        @endauth  
                    </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <!-- ==================== ADICIONE BADGE DE PAPEL ==================== -->
                            <li class="nav-item">
                                <span class="nav-link badge 
                                    @if(Auth::user()->role === 'admin') bg-danger
                                    @elseif(Auth::user()->role === 'bibliotecario') bg-warning text-dark
                                    @else bg-info @endif">
                                    {{ Auth::user()->role }}
                                </span>
                            </li>
                            <!-- ==================== FIM DO BADGE ==================== -->
                            
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="bi bi-person-circle"></i> {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <!-- ==================== ADICIONE LINK DO PERFIL ==================== -->
                                    
                                      
                                    <div class="dropdown-divider"></div>
                                    <!-- ==================== FIM DOS LINKS ==================== -->
                                    
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="bi bi-box-arrow-right"></i> {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
