<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{asset('font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">

</head>
<body>
<div id="app">
    <nav class="navbar sticky-top navbar-expand-lg navbar-dark  top-nav" style="background-color: #000000">
        <div class="container" style="background-color: #000000;">
            <a class="navbar-brand" href="{{ url('/') }}" style=" font-size: 25px;font-family:'Calibri Light';">
                {{ config('app.name', 'ADALA E-FASHION') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>Menu
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="" style="color: white;padding-right: 20px"><i class="fa fa-female"></i>&nbsp;{{ __('WOMEN') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="" style="color: white;"><i class="fa fa-male"></i>&nbsp;{{ __('MEN') }}</a>
                    </li>&nbsp;


                </ul>
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <form class="form-inline my-2 my-lg-0" style="padding-right: 20px">
                            <input class="form-control mr-sm-2" type="search" placeholder="search a product" style="width:280px">
                            <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Search</button>
                        </form>
                    </li>
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}"  style="color: white;padding-right: 20px"><i class="fa fa-sign-in"></i>{{ __('Login') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }} " style="color: white;"><i class="fa fa-user-plus"></i>{{ __('Register') }}</a>
                        </li>
                        @else
                            <li class="nav-item dropdown">
                                <a style="color: white;" id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="">
                                        {{ __('Change Password') }}
                                    </a>
                                    <a class="dropdown-item" href="">
                                        {{ __('My Orders') }}
                                    </a>
                                    <a class="dropdown-item" href="">
                                        {{ __('Help') }}
                                    </a>
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
                            <li class="nav-item">
                                <a class="nav-link" href="{{url('/cart')}}" style="color: white;"><i class="fa fa-shopping-cart"></i>&nbsp;Cart&nbsp;({{Cart::instance('default')->count(false)}})</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{url('/wishlist')}}" style="color: white;"><i class="fa fa-heart-o"></i>&nbsp;Wishlist&nbsp;({{Cart::instance('wishlist')->count(false)}})</a>
                            </li>

                </ul>
            </div>
        </div>

    </nav>

    <main class="py-4">
        @include('flash::message')
        @yield('content')
    </main>
</div>
</body>
</html>
