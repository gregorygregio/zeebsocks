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
                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ route("home") }}">
                        Zeeb Socks
                    </a>
                </div>

            </div>
        </nav>

        <div class="navbar-space-bot"></div>

        <div class="container">
            <div class="row">
              <div class="col-md-10 col-xs-12">
                @yield('content')
              </div>

              <div class="col-md-2 col-xs-12 text-center">
              </div>
            </div>
        </div>
    </div>
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

                </div>
            </div>




            <div class="col-md-4 col-xs-12 ">
              <div class="social-media">
                  <a>
                      <img src="{{ asset("/images/facebook.png") }}" />
                  </a>
                  <a>
                      <img src="{{ asset("/images/instagram.png") }}" />
                  </a>
              </div>
            </div>
        </div>
    </div>
</footer>
</html>
