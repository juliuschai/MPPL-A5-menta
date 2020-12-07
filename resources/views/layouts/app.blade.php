<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>     <!-- jQuery and bootstrap included -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.5.4/umd/popper.min.js" defer></script>

    <!-- Plugins -->
    {{-- <script src="{{ asset('js/scrollreveal.min.js') }}" defer></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/scrollReveal.js/4.0.7/scrollreveal.min.js" integrity="sha512-yrp2XCY0JvwOgu87K/vTN3IIHolfAJL3SMsFu0ujdKeWWMmFhClABdlxna2TfOhMqX49GbmsIpbZ6fVBE7gleQ==" crossorigin="anonymous" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/noframework.waypoints.min.js" integrity="sha512-fHXRw0CXruAoINU11+hgqYvY/PcsOWzmj0QmcSOtjlJcqITbPyypc8cYpidjPurWpCnlB8VKfRwx6PIpASCUkQ==" crossorigin="anonymous" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Counter-Up/1.0.0/jquery.counterup.min.js" integrity="sha512-d8F1J2kyiRowBB/8/pAWsqUl0wSEOkG5KATkVV4slfblq9VRQ6MyDZVxWl2tWd+mPhuCbpTB4M7uU/x9FlgQ9Q==" crossorigin="anonymous" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/imgix.js/3.4.2/imgix.js" integrity="sha512-pFm7Rz0M+6TD/4tY+f2AuP+CffGsWKrR06J9+2yxxMf20NGI/jl7npF3WbEZeOpubYrl8qu4nScHSLWC6OMmyw==" crossorigin="anonymous" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mixitup/3.3.1/mixitup.min.js" integrity="sha512-nKZDK+ztK6Ug+2B6DZx+QtgeyAmo9YThZob8O3xgjqhw2IVQdAITFasl/jqbyDwclMkLXFOZRiytnUrXk/PM6A==" crossorigin="anonymous" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" integrity="sha512-uto9mlQzrs59VwILcLiRYeLKPPbS/bT71da/OEBYEwcdNUk8jYIy+D176RYoop1Da+f9mvkYrmj5MCLZWEtQuA==" crossorigin="anonymous" defer></script>

    <!-- Global Init -->
    <script src="{{ asset('js/custom.js') }}" defer></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
        integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA=="
        crossorigin="anonymous" />

</head>

<body class="dark-blue menta-text-font">
    {{-- disabled for development --}}
    <div id="js-preloader" class="js-preloader">
        <div class="preloader-inner">
            <span class="dot"></span>
            <div class="dots">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <div id="app">
        <header class="header-area header-sticky">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <nav class="main-nav">

                            {{-- <a href="{{ route('index') }}" class="logo">MENTA<em> KONSELING</em></a> --}}
                            <a href="{{ route('index') }}" class="logo">MENTA<em> KONSELING</em></a>

                            <ul class="nav">
                                <li><a href="{{ route('index') }}">Beranda</a></li>
                                <li><a href="{{ route('about') }}">Tentang</a></li>
                                {{-- <li class="scroll-to-section"><a href="#top" class="active">Beranda</a></li>
                                <li class="scroll-to-section"><a href="#features">Tentang</a></li> --}}
                                <li class="scroll-to-section"><a href="#our-classes">Artikel</a></li>
                                <li class="main-button"><a href="{{ route('login') }}">Masuk</a></li>
                                {{-- <li class="main-button"><a href="#our-classes">Masuk</a></li> --}}
                            </ul>
                            <a class='menu-trigger'>
                                <span>Menu</span>
                            </a>

                        </nav>
                    </div>
                </div>
            </div>
        </header>

        @yield('content')
    </div>

    <footer class="container text-white">
        <div class="row p-4 justify-content-center">
            <img src="{{ asset('img/MENTA-logo-text-white.png') }}">
        </div>
        <div class="row p-5">
            <div class="col-sm">
                <div class="footer-title">Site map</div>
                <br>
                FAQ <br>
                Security <br>
                Beranda <br>
                Tentang <br>
            </div>
            <div class="col-sm">
                <div class="footer-title">Hubungi Kami</div>
                <br>
                Jl. Sosio Humaniora Bulaksumur, Karang Malang, Caturtunggal,
                Kec. Depok, Kabupaten Sleman, Daerah Istimewa Yogyakarta,
                Fakultas Psikologi Universitas Gadjah Mada <br>
                <br>
                Email : help@menta.com
            </div>
            <div class="col-sm">
                <div class="footer-title">Apakah kamu terapis?</div>
                <a href="{{ route('therapist.index') }}">
                    <button class="yellow text-white" style="">
                        Register
                    </button>
                </a>
            </div>
        </div>
    </footer>

    @yield('scripts')
</body>

</html>
