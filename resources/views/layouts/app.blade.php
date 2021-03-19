<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" href="{{ asset('storage/images/logo.png') }}" type="image/x-icon" />

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('scss/style.scss') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
        integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

</head>

<body>
    <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-default">
            <div class="container">
                <a class="navbar-brand denima" href="{{ url('/home') }}">
                    <b>D</b>ENiMA
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link drop-default"
                                href="{{ route('category', ['category_id' => '1']) }}">{{ __('Men') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link drop-default"
                                href="{{ route('category', ['category_id' => '2']) }}">{{ __('Women') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link drop-default"
                                href="{{ route('category', ['category_id' => '3']) }}">{{ __('Children') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link drop-default" href="{{ route('cart') }}">
                                @php
                                    $cart = session()->get('cart');
                                    $num = 0;
                                    if ($cart) {
                                        foreach ($cart as $id) {
                                            $num += $id['quantity'];
                                        }
                                    }
                                    echo '<i class="fas fa-shopping-cart"></i> <span> ' . ($num > 0 ? ' ' . $num . '</span>' : '0</span>');
                                @endphp
                            </a>
                        </li>
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link drop-default" href="{{ route('login') }}"><i
                                            class="far fa-user"></i></a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown drop-default">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle drop-default" href="#" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="far fa-user mr-2"></i>{{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right drop-default" aria-labelledby="navbarDropdown">

                                    <a class="dropdown-item drop-default" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                                    document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
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

        <main class="py-4 my-4 content">
            @yield('content')
        </main>
    </div>

    <footer class="footer d-flex justify-content-between align-items-bottom">
        <div class="social-media ml-1">
            <h3 class="theme">Follow Us</h3>
            <p class="m-1"><i class="fab fa-facebook"></i> /Denima_Original</p>
            <p class="m-1"><i class="fab fa-twitter"></i> @Denima</p>
            <p class="m-1"><i class="fab fa-instagram"></i> @Denima_Original</p>
        </div>

        <div class="additional-contact ml-1">
            <h3 class="theme">Contact Info</h3>
            <p class="m-1"><i class="far fa-envelope"></i> denima@ecommerce.co</p>
            <p class="m-1"><i class="fas fa-phone-square"></i> +1234 5678 9120</p>
        </div>

        <div class="mr-4 copyright">
            <p>Copyright Denima 2020</p>
        </div>
    </footer>

    <div class="loader-wrapper">
        <span class="loader"><span class="loader-inner"></span></span>
    </div>
    <script>
        $(window).on("load", function() {
            $(".loader-wrapper").fadeOut("slow");
        });
    </script>
</body>

@yield('scripts')

</html>
