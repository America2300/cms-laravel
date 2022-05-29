<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!--Metas-->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="title" content="Noticias de Harry Potter">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Noticias de Harry Potter') }}</title>

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>

<nav>
    <div class="nav-wrapper">
        <!--Logo-->
        <a href="{{ route('home') }}" class="brand-logo" title="Inicio">
            {{ Html::image('img/logo.svg', 'Logo Harry Potter') }}
        </a>

        <!--Botón menú móviles-->
        <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>

        <!--Menú de navegación-->
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li>
                <a href="{{ route('home') }}" title="Inicio">Inicio</a>
            </li>
            <li>
                <a href="{{ route('noticias') }}" title="Noticias">Noticias</a>
            </li>
            <li>
                <a href="{{ route('acerca-de') }}" title="Acerca de">Acerca de</a>
            </li>
            <li>
                <a href="{{ route('admin') }}" title="Panel de administración" target="_blank" class="grey-text">
                    Admin
                </a>
            </li>
        </ul>

    </div>
</nav>

<!--Menú de navegación móvil-->
<ul class="sidenav" id="mobile-demo">
    <li>
        <a href="{{ route('home') }}" title="Inicio">Inicio</a>
    </li>
    <li>
        <a href="{{ route('noticias') }}" title="Noticias">Noticias</a>
    </li>
    <li>
        <a href="{{ route('acerca-de') }}" title="Acerca de">Acerca de</a>
    </li>
    <li>
        <a href="{{ route('admin') }}" title="Panel de administración" target="_blank" class="grey-text">
            Admin
        </a>
    </li>
</ul>

<main>

    <header>
        <h1>Mi primer CMS</h1>
        <h2>con Laravel</h2>
    </header>

    <section class="container-fluid">

        <!--Content-->
    @yield('content')

    <!--Footer-->
    </section>
</main>

<footer class="center-align">
    © <?php echo date("Y") ?>
    <a href="https://jairogarciarincon.com" target="_blank" title="Jairo García Rincón">
        Jairo García Rincón
    </a>
</footer>

</body>

<!--Scripts-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script src="{{ asset('js/app.js') }}" defer></script>

</html>
