

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Интернет Магазин: @yield('title')</title>

    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/starter-template.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container"  >
        <div class="navbar-header">
            <a class="navbar-brand" href="{{route('index')}}">Интернет Магазин</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="{{route('index')}}">Все товары</a></li>
                <li ><a href="{{route('categories')}}">Категории</a>
                </li>
                <li ><a href="{{route('basket')}}">В корзину</a></li>
                <li><a href="{{route('index')}}">Сбросить проект в начальное состояние</a></li>
                <li><a href="http://internet-shop.tmweb.ru/locale/en">en</a></li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">₽<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="http://internet-shop.tmweb.ru/currency/RUB">₽</a></li>
                        <li><a href="http://internet-shop.tmweb.ru/currency/USD">$</a></li>
                        <li><a href="http://internet-shop.tmweb.ru/currency/EUR">€</a></li>
                    </ul>
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <ul class="navbar-nav ml-auto" style="margin-top: 13px;">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item" style="margin:0 10px ">
                            <a class="nav-link" href="{{ route('login') }}">Войти</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">Зарегистрироваться</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" style="text-align: center; padding: 5px 0; " >
                                <a class="dropdown-item" href="{{ route('logout') }} "
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                   Выйти
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>

            </ul>

        </div>
    </div>
</nav>

<div class="container">
<div class="starter-template">

    @if(session()->has('success'))
        <p class="alert alert-success">{{session()->get('success')}}</p>
    @endif
    @if(session()->has('warning'))
        <p class="alert alert-warning">{{session()->get('warning')}}</p>
    @endif

    @yield('content')
</div>

</div>
</body>
</html>
