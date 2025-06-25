<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Sou-Todo</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('task.index') }}">
                <i class="fas fa-tasks me-2"></i>Sou Todo
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="navbar-nav ms-auto d-flex align-items-center">
                    @auth
                        <div class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li>
                                    <a class="dropdown-item" href="{{ route('profile.edit') }}">{{ __('Profile') }}</a>
                                </li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Đăng xuất</button>
                                    </form>
                                </li>

                            </ul>
                        </div>
                    @else
                        <a class="nav-link" href="{{ route('login') }}">Đăng nhập</a>
                        <a class="nav-link" href="{{ route('register') }}">Đăng ký</a>
                    @endauth
                    <div class="social-icons d-flex">
                        <a href="https://www.facebook.com/sonthichnovel" class="text-decoration-none" target="_blank"
                            rel="noopener">
                            <i class="fab fa-facebook"></i>
                        </a>
                        <a href="https://github.com/BiUsagi" class="text-decoration-none" target="_blank"
                            rel="noopener">
                            <i class="fab fa-github"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>


    <!-- Main Content -->
    @yield('content')
    <script>
        @if (isset($tasks))
            window.tasks = @json($tasks);
        @endif
    </script>
    <script src="{{ asset('js/script.js') }}"></script>
</body>

</html>
