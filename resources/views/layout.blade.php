<!DOCTYPE html>
<html lang="uk">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('app-title', 'Добрі лапи')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background-color: #d6e8e4;">

    <div class="container">

        <header class="py-3 mb-4 border-bottom">

            <div class="d-flex justify-content-between align-items-start">

                <a href="/" class="d-flex align-items-center text-decoration-none">

                    <div class="me-2 fs-4 d-flex align-items-start" style="line-height: 1;">
                        🐾
                    </div>

                    <div style="line-height: 1.2;">
                        <div class="fw-bold text-primary" style="font-size: 22px;">
                            Добрі лапи
                        </div>

                        <div class="text-muted small">
                            притулок для тварин
                        </div>
                    </div>

                </a>

                <div class="d-flex align-items-center gap-2">

                    @guest

                        <a href="{{ route('login') }}" class="btn btn-outline-primary">
                            Увійти
                        </a>

                        <a href="{{ route('register') }}" class="btn btn-primary">
                            Реєстрація
                        </a>

                    @else

                        <span class="fw-bold mt-2">
                            {{ Auth::user()->name }}
                            <a href="/profile" class="btn btn-outline-secondary me-2">
                                Профіль
                            </a>
                        </span>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">

                            @csrf

                        </form>

                    @endguest

                </div>

            </div>

            <ul class="nav nav-pills mt-4 justify-content-center bg-white shadow-sm rounded-pill p-3">

                <li class="nav-item">
                    <a href="/" class="nav-link {{ request()->is('/') ? 'active' : '' }}">
                        Головна сторінка
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/animals" class="nav-link {{ request()->is('animals') ? 'active' : '' }}">
                        Тварини
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/about" class="nav-link {{ request()->is('about') ? 'active' : '' }}">
                        Про притулок
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/help" class="nav-link {{ request()->is('help') ? 'active' : '' }}">
                        Допомога
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/news" class="nav-link {{ request()->is('news') ? 'active' : '' }}">
                        Новини
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/contacts" class="nav-link {{ request()->is('contacts') ? 'active' : '' }}">
                        Контакти
                    </a>
                </li>

                @auth
                    @if(Auth::user()->isAdmin() || Auth::user()->isManager())

                        <li class="nav-item">
                            <a href="/applications" class="nav-link {{ request()->is('applications') ? 'active' : '' }}">
                                Заявки на усиновлення
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="/help_requests" class="nav-link {{ request()->is('help_requests') ? 'active' : '' }}">
                                Заявки на допомогу
                            </a>
                        </li>
                    @endif
                    @if(Auth::user()->isAdmin())

                        <li class="nav-item">
                            <a href="/users" class="nav-link {{ request()->is('users*') ? 'active' : '' }}">
                                Користувачі
                            </a>
                        </li>

                    @endif
                @endauth

            </ul>

        </header>



        <main>
            @yield('page-content')
        </main>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <footer class="mt-5 border-top shadow-sm" style="background-color: #bfd3cd;">

        <div class="container py-4">

            <div class="row">

                <div class="col-md-4 mb-3">

                    <h5 class="fw-bold">
                        Добрі лапи
                    </h5>

                    <p class="text-muted mb-0">
                        Притулок для тварин, які шукають новий дім.
                    </p>

                </div>

                <div class="col-md-4 mb-3">

                    <h5 class="fw-bold">
                        Навігація
                    </h5>

                    <ul class="list-unstyled">

                        <li>
                            <a href="/" class="text-decoration-none">
                                Головна
                            </a>
                        </li>

                        <li>
                            <a href="/animals" class="text-decoration-none">
                                Тварини
                            </a>
                        </li>

                        <li>
                            <a href="/about" class="text-decoration-none">
                                Про притулок
                            </a>
                        </li>

                        <li>
                            <a href="/contacts" class="text-decoration-none">
                                Контакти
                            </a>
                        </li>

                    </ul>

                </div>

                <div class="col-md-4 mb-3">

                    <h5 class="fw-bold">
                        Контакти
                    </h5>

                    <p class="mb-1">
                        Email: help@dobrilapy.ua
                    </p>

                    <p class="mb-1">
                        Телефон: +380 67 123 45 67
                    </p>

                    <p class="mb-0">
                        Хмельницький, Україна
                    </p>

                </div>

            </div>

            <hr>

            <div class="text-center text-muted">

                © {{ date('Y') }} Добрі лапи. Всі права захищені.

            </div>

        </div>

    </footer>

</body>

</html>