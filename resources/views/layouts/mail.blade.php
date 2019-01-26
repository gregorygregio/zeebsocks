<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Zeeb | @yield('title')</title>

    <style>
      body {
        font-family: Raleway,sans-serif;
        font-size: 14px;
        line-height: 1.6;
        color: #636b6f;
        background-color: #fff;
        margin: 0;
        padding: 0;
      }
      *, :after, :before {
          -webkit-box-sizing: border-box;
          box-sizing: border-box;
      }
      a {
        text-decoration: none;
        color: inherit;
      }
      nav.navbar, .navbar-space-bot{
          min-height: 50px;
      }
      nav.navbar{
          position: fixed;
          border: 1px solid transparent;
          border-bottom-color: #d3e0e9;
          box-shadow: 0 1px 3px #d3e0e9;
          width: 100vw;
          top: 0;
          border-radius: 0;
          z-index: 1000;
          background-color: #fff;
      }
      .container{
          width: 84%;
          margin-right: auto;
          margin-left: auto;
          padding-left: 15px;
          padding-right: 15px;
      }
      .navbar-header {
          float: left;
      }
      .navbar-brand {
          float: left;
          padding: 14px 15px;
          font-size: 20px;
          line-height: 22px;
          height: 50px;
          color: #777;
          margin-left: -15px;
          text-decoration: none;
          background-color: transparent;
      }

      .banner{
        width: 100%;
        text-align: center;
        background-color: #f5f8fa;
        height: 160px;
      }
      #zeebLogo {
        float: left;
        width: 160px;
        margin: auto;
      }
      #zeebLogo img{
        width: 100%;
      }
      .banner-title{
        font-size: 36px;
        font-weight: bold;
        text-align: left;
        padding-left: 100px;
        padding-top: 40px;
        margin-left: 160px;
      }
      .content{
        font-size: 26px;
      }
      @yield('custom-css-links')
    </style>
</head>
<body>
    <nav class="navbar">
      <div class="container">
        <div class="navbar-header">
            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ route("home") }}" target="_blank">
                Zeeb Socks
            </a>
        </div>
      </div>
    </nav>

    <div class="navbar-space-bot"></div>

    <div class="banner">
      <div id="zeebLogo">
          <img src="{{ asset("/images/logo.jpeg") }}"/>
      </div>
      <div class="banner-title">
        @yield('main-message')
      </div>
    </div>


    <div class="container content">
      @yield('content')
    </div>

</html>
