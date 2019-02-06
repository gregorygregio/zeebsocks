<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Zeeb | @yield('title')</title>

    <!-- Styles -->

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    @yield('custom-css-links')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ route("home") }}">
                        Zeeb Socks
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">


                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>

                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>


                                        <a href="{{ route('user.index') }}" >
                                            Minha Conta
                                        </a>

                                        <a href="{{ route('pedido.list') }}" >
                                            Meus Pedidos
                                        </a>

                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>


                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                        <li class="cart-option"><a href="{{ route('cart') }}"><i class="fa fa-shopping-cart "></i>
                            @if(App\Entities\Cart::countItems() > 0)
                                <div class="pull-right">
                                    <span class="label label-pill label-primary label-as-badge">
                                        {{ App\Entities\Cart::countItems() }}
                                    </span>
                                </div>
                            @endif
                        </a></li>


                    </ul>
                </div>
            </div>
        </nav>

        <div class="navbar-space-bot"></div>


        @yield('content')

    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('custom-js-links')
</body>



<footer>
    <div class="container">
        <div class="row">





            <!-- LOGO -->
            <div class="col-md-4 col-xs-12 text-center">
                <img src="{{ asset("/images/logo.jpeg") }}" class="logo"/>
            </div>








            <!-- CONTATO -->
            <div class="col-md-4 col-xs-12 ">
                <div class="info-contato text-center">

                    <br>
                    <br>
                    <h3><i class="fa fa-phone "></i> (11) 99999-9999</h3>
                    <h3><i class="fa fa-envelope"></i> contato@zeebsocks.com</h3>
                    <div class="social-media">
                        <a>
                            <img src="{{ asset("/images/facebook.png") }}" />
                        </a>
                        <a>
                            <img src="{{ asset("/images/instagram.png") }}" />
                        </a>
                    </div>
                    <div class="social-media">

                    </div>
                </div>
            </div>











            <!-- ENTRE EM CONTATO -->


            <div class="col-md-4 col-xs-12">
                <h3>Entre em contato conosco</h3>
                <form id="contactForm" action="{{ route('contactmail') }}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <input type="text" class="form-control" id="contactFormName" placeholder="Nome" name="name">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="contactFormEmail" placeholder="E-mail" name="email" value="{{ Auth::check() ? Auth::user()->email : "" }}">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" id="contactFormMessage" placeholder="Mensagem" rows="3" name="message"></textarea>
                    </div>


                    @if(session('success'))
                        <div class="alert alert-success text-center">
                            {{ session('success')  }}
                        </div>
                    @elseif(session('error'))
                        <div class="alert alert-danger text-center">
                            {{ session('error')  }}
                        </div>
                    @endif


                    <button class="btn btn-primary pull-right">
                        ENVIAR
                    </button>
                </form>
            </div>









        </div>
    </div>
</footer>
</html>
