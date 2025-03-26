<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    @yield('styles')

    {{-- <link rel="stylesheet" href="{{ asset('css/company.style.css')}}"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- Styles --}}
    @yield('styles')


    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<style>
    body {
        background-color: #F4EEE0;
    }
    .navbar{
        background-color: #424242;
    }
  .image-container {
    position: relative; /* 基準となるコンテナ */
}

.overlay-image {
    position: absolute;
    top: 40%; /* 画像の上に配置（調整可） */
    left: 55%; /* 水平方向の位置（調整可） */
    transform: translate(-50%, -50%); /* 画像の中央に配置 */

}

.icon-md {
    font-size: 1.5rem;
    vertical-align: middle;
    margin-right: 10px;
}

</style>

<body style="font-family: Georgia, 'Times New Roman', Times, serif; ">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <div class="image-container">
                        <img src="{{ asset('images/gu ld (1).png')}}" alt="Base Image" class="base-image">
                        <img src="{{ asset('images/logo-removebg-preview 1 (2).png')}}" alt="Overlay Image" class="overlay-image">
                    </div>

                </a>
                <button class="navbar-toggler " type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li> <a href="{{ route('company.project.on_going')}}" class="text-decoration-none text-white">On-Going</a></li>
                        <li class="ms-4"> <a href="{{ route('company.project.list')}}" class="text-decoration-none text-white">Job list</a></li>

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto d-flex align-items-center">
                        <!-- Authentication Links -->
                        <li><a href="{{ route('company.contact.with_freelancer', Auth::user()->id)}}" class="text-decoration-none text-white"><i class="fa-regular fa-envelope icon-md"></i></a></li>
                        @guest
                            @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @endif

                            @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <!-- Profile Link -->
                                    <a class="dropdown-item" href="{{ route('company.profile.profile', Auth::user()->id) }}">
                                        {{ __('Profile') }}
                                    </a>

                                    <!-- Contact Link -->
                                    <a class="dropdown-item" href="{{ route('company.contact.contact', Auth::user()->id) }}">
                                        {{ __('Contact') }}
                                    </a>
                                    <hr>
                                    <!-- Log Out -->
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
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

        <main class="">
            @yield('content')
        </main>
    </div>
</body>
</html>
