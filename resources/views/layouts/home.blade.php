<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="robots" content="all,follow">

    <title>Ligas de Domino</title>

    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.css')}}">
    <!-- <link rel="stylesheet" type="text/css" href="{{asset('css/animate.css')}}"> -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/font-awesome.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('style.css')}}">

    <link rel="icon" type="image/png" href="{{asset('img/favicon.png')}}" />


</head>
<body>
<header>
    <nav class="navbar fixed-top navbar-toggleable-md navbar-light bg-faded" data-toggle="affix">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="/"><img class="d-inline-block primary-image"
                                              src="{{asset('img/logo-ligas-domino.png')}}"></a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdownMenu1" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">
                        Ligas
                    </a>
                    <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                        <li class="dropdown-submenu">
                            <a class="dropdown-item" tabindex="-1" href="#">Venezuela</a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-item"><a href="#">Amazonas</a></li>
                                <li class="dropdown-item"><a href="#">Anzoátegui</a></li>
                                <li class="dropdown-item"><a href="#">Apure</a></li>
                                <li class="dropdown-item"><a href="#">Aragua</a></li>
                                <li class="dropdown-item"><a href="#">Barinas</a></li>
                                <li class="dropdown-item"><a href="#">Bolívar</a></li>
                                <li class="dropdown-item"><a href="#">Carabobo</a></li>
                                <li class="dropdown-item"><a href="#">Cojedes</a></li>
                                <li class="dropdown-item"><a href="#">Delta Amacuro</a></li>
                                <li class="dropdown-item"><a href="#">Distrito Capital</a></li>
                                <li class="dropdown-item"><a href="#">Falcón</a></li>
                                <li class="dropdown-item"><a href="#">Guárico</a></li>
                                <li class="dropdown-item"><a href="/lara">Lara</a></li>
                                <li class="dropdown-item"><a href="#">Mérida</a></li>
                                <li class="dropdown-item"><a href="#">Miranda</a></li>
                                <li class="dropdown-item"><a href="#">Monagas</a></li>
                                <li class="dropdown-item"><a href="#">Nueva Esparta</a></li>
                                <li class="dropdown-item"><a href="#">Portuguesa</a></li>
                                <li class="dropdown-item"><a href="#">Sucre</a></li>
                                <li class="dropdown-item"><a href="#">Táchira</a></li>
                                <li class="dropdown-item"><a href="#">Trujillo</a></li>
                                <li class="dropdown-item"><a href="#">Vargas</a></li>
                                <li class="dropdown-item"><a href="#">Yaracuy</a></li>
                                <li class="dropdown-item"><a href="#">Zulia</a></li>
                                <li class="dropdown-item"><a href="#">Dependencias Federales</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-item"><a href="#">Cuba</a></li>
                        <li class="dropdown-item"><a href="#">Curazao</a></li>
                        <li class="dropdown-item"><a href="#">Panamá</a></li>
                        <li class="dropdown-item"><a href="#">República Dominicana</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Nosotros</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Noticias</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Galerías</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Videos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contactanos</a>
                </li>
            </ul>


            <ul class="nav navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Ingresar</a></li>
                @else
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-expanded="false" aria-haspopup="true">
                            <img class="imgCircle2" src="{{ asset(Auth::user()->url_image) }}">
                            {!! ucwords(strtolower(Auth::user()->name)) !!}
                            <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu multi-level">
                            <li class="dropdown-item">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    Cerrar sesión
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                    @endguest
            </ul>


        </div>
    </nav>
</header>


@yield('content')


<footer>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <img src="{{asset('img/logo-liga-domino-footer.png')}}" align="left">
                <p>"Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit..."</p>

                <p>"No hay nadie que ame el dolor mismo, que lo busque, lo encuentre y lo quiera, simplemente porque es
                    el dolor."</p>
            </div>
            <div class="col-sm-6">
                <p align="right">Desarrollado por ArcontesPX</p>
            </div>
        </div>
    </div>
</footer>


<script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
<script src="{{asset('js/tether.min.js')}}"></script>
<script src="{{asset('js/bootstrap.js')}}"></script>
<script src="{{asset('js/wow.js')}}"></script>
<script src="{{asset('js/wow-custom.js')}}"></script>
<script src="{{asset('js/desplazamiento-scroll.js')}}"></script>
<script>//logo affix-fixed-sticky
    var urlLogo = '{{ URL::asset('img/') }}';
</script>
<script src="{{asset('js/affix-fixed-sticky.js')}}"></script>


<script type="text/javascript"> //parallax
    (function () {
        var parallax = document.querySelectorAll(".parallax"),
                speed = 0.2;
        window.onscroll = function () {
            [].slice.call(parallax).forEach(function (el, i) {
                var windowYOffset = window.pageYOffset,
                        elBackgrounPos = "50% " + (windowYOffset * speed) + "px";
                el.style.backgroundPosition = elBackgrounPos;
            });
        };

    })();
</script>
<script>
    $('.show-hide').click(function(){
        $('.collapse').collapse('hide');
    });
</script>
</body>
</html>
