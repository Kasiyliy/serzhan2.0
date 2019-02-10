<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->

    <script src="{{ asset('public/js/app.js') }}"></script>
    <script src="{{ asset('public/js/toastr.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->

    <link href="{{ asset('public/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/toastr.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-sm navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4 px-2">
            <div class="row">
                @if(Auth::user())
                    <div class="col-3">
                        <div class="card">
                            <div class="border-right" >
                                <div class="list-group ">
                                    <a href="/about" class="list-group-item list-group-item-action ">О нас</a>
                                    <a href="/categories" class="list-group-item list-group-item-action ">Категории</a>
                                    <a href="#" class="list-group-item list-group-item-action ">Overview</a>
                                    <a href="/roles" class="list-group-item list-group-item-action ">Роли</a>
                                    <a href="#" class="list-group-item list-group-item-action ">Events</a>
                                    <a href="#" class="list-group-item list-group-item-action ">Profile</a>
                                    <a href="/clients" class="list-group-item list-group-item-action ">Клиенты</a>
                                    <a href="/statuses" class="list-group-item list-group-item-action ">Статусы</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-9">
                        @yield('content')
                    </div>
                @else
                    <div class="col-12">
                        @yield('content')
                    </div>
                @endif
            </div>
        </main>
    </div>

    <script>
        toastr.options.closeButton = true;
        @if(Session::has('success'))
        toastr.success("{{Session::get('success')}}");
        @endif

        @if(Session::has('info'))
        toastr.info("{{Session::get('info')}}");
        @endif

        @if(Session::has('error'))
        toastr.info("{{Session::get('error')}}");
        @endif

        @if(Session::has('warning'))
        toastr.info("{{Session::get('warning')}}");
        @endif

    </script>
</body>
</html>
