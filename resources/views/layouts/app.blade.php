<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Curiositiz') }}</title>

    <!-- Styles -->
    @vite(['resources/assets/sass/main.scss', 'resources/assets/js/main.js'])
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"
          integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Montserrat|Poppins" rel="stylesheet">

    <link rel="icon" type="image/png" href="{{ asset('images/curiositiz_png_blc_rvb.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/curiositiz_png_blc_rvb.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/curiositiz_png_blc_rvb.png') }}">
    <link rel="manifest" href="{{ asset('images/favicon/site.webmanifest') }}">
    <link rel="mask-icon" href="{{ asset('images/favicon/safari-pinned-tab.svg') }}" color="#B24592">
    <meta name="msapplication-TileColor" content="#B24592">
    <meta name="theme-color" content="#B24592">

    <style>
        html, body { max-width: 100%; overflow-x: hidden; }
        .site-content { min-height: 100vh; }
        .dashboard-image {
            background-image: url( <?php echo asset('images/index_picture.jpg'); ?> );
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            position: absolute;
            height: 100%;
            width: 100%;
            margin-left: 300px;
        }
        #collapse { display: none; }
        @media screen and (max-width: 1100px) {
            .dashboard-image {
                background-image: url( <?php echo asset('images/index_picture.jpg'); ?> );
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
                filter: opacity(22%);
                height: 100%;
                width: 100%;
                margin-left: 0;
            }
            #collapse { display: flex; }
        }
        .content-button-active { color: #fff !important; }
        .box-info { flex-direction: column; display: flex; align-items: center; margin-bottom: 30px; margin-top: 30px; }
        .box-info span { color: #B24592 !important; font-size: 1.2em; }
        body { background-color: #f1f1f1; }
        a { color: #1d3557 !important; }
        .alert-update-profile { width: 50%; text-align: center; margin-left: 300px }
        @media screen and (max-width: 700px) {
            .alert-update-profile { margin-left: 70px; width: 80%; }
        }
        .btn-social { position: relative; padding-left: 44px; text-align: left; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .btn-facebook { color: #fff !important; background-color: #3b5998; border-color: rgba(0,0,0,.2); }
        .btn-google { color: #fff !important; background-color: #dd4b39; border-color: rgba(0,0,0,.2); }
    </style>
</head>
<body>
@section('sidebar')

    {{------------------------------------- Menu mobile ---------------------------------------------------}}
    <button type="button" class="navbar-toggler" data-toggle="modal" data-target="#modal-menu" id="modal-menu-button">
        <div class="burger-bar"></div>
        <div class="burger-bar"></div>
        <div class="burger-bar"></div>
    </button>
    <div class="row">
        <div class="col-4">
            <a class="button-back" style="color: #007bff;" href="{{ url()->previous() }}">< Retour </a>
        </div>
    </div>
    <div class="modal fade" id="modal-menu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" id="modal-menu-content">
                <div class="modal-body" id="modal-menu-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="modal-menu-close-button">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="sidebar-header">
                        <a class="" href="{{ route('home') }}"><img class="sidebar-logo" src="{{ asset("/images/curiositiz_png_blc_rvb_white.png") }}" alt="" width=""></a>
                        <a href="{{ route('home') }}"><img class="sidebar-logo-single" src="{{ asset("/images/curiositiz_png_blc_rvb_white.png") }}" alt=""></a>
                    </div>
                    <nav>
                        <ul class="sidebar-list">
                            <li class="sidebar-item">
                                <a class="sidebar-button" href="{{ route('home') }}">Accueil</a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-button" href="{{ route('about') }}">Qui sommes nous ?</a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-button" href="{{ route('sheet.index') }}">Bons plans</a>
                            </li>
                        </ul>
                        <hr class="sidebar-divider-nav">

                        @guest
                            <ul class="sidebar-list">
                                <li class="sidebar-item"><a class="sidebar-button-disabled" href="#">Mes réservations</a></li>
                                <li class="sidebar-item"><a class="sidebar-button-disabled" href="#">Créer un atelier</a></li>
                                <li class="sidebar-item"><a class="sidebar-button-disabled" href="#">Mes ateliers publiés</a></li>
                            </ul>
                            <hr class="sidebar-divider-nav">
                            <ul class="sidebar-list">
                                <li class="sidebar-item"><a class="sidebar-button-disabled" href="#">Nous contacter</a></li>
                                <hr class="sidebar-divider-nav">
                                <li class="sidebar-item"><a href="{{ route('login') }}" class="sidebar-button">Connexion</a></li>
                            </ul>
                        @endguest

                        @auth
                            <ul class="sidebar-list">
                                <li class="sidebar-item">
                                    <a class="sidebar-button" href="{{ route('workshop.next', ['slug' => Auth::user()->slug]) }}">Mes réservations</a>
                                </li>
                                <li class="sidebar-item">
                                    <a class="sidebar-button" href="{{ route('workshop.create') }}">Créer un atelier</a>
                                </li>
                                <li class="sidebar-item">
                                    <a class="sidebar-button" href="{{ route('workshop.mine', ['slug' => Auth::user()->slug]) }}">Mes ateliers publiés</a>
                                </li>
                            </ul>
                            <hr class="sidebar-divider-nav">
                            <ul class="sidebar-list">
                                <li class="sidebar-item">
                                    <a class="sidebar-button" href="{{ route('user.edit', Auth::user()->id) }}">Mon profil</a>
                                </li>
                                <li class="sidebar-item">
                                    <a class="sidebar-button" href="{{ route('contact') }}">Nous contacter</a>
                                </li>
                                <li class="sidebar-item">
                                    <a class="sidebar-button" href="{{ asset("/pdf/cgu/CGU.pdf") }}" target="_blank">Mentions légales - CGU</a>
                                </li>
                                <hr class="sidebar-divider-nav">
                                @if(Auth::user()->isAdmin())
                                    <li class="sidebar-item">
                                        <a class="sidebar-button" href="{{ route('admin') }}">Administration</a>
                                    </li>
                                @endif
                                <li class="sidebar-item">
                                    <a class="sidebar-button" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();">Déconnexion</a>
                                    <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        @endauth
                    </nav>
                </div>
            </div>
        </div>
    </div>

    {{------------------------- Menu desktop -------------------}}
    <div class="site-sidebar" id="sidebar">
        <div class="sidebar-header mb-0">
            <a class="" href="{{ route('home') }}"><img class="sidebar-logo" src="{{ asset("/images/curiositiz_png_blc_rvb_white.png") }}" alt="" width=""></a>
            <a href="{{ route('home') }}"><img class="sidebar-logo-single" src="{{ asset("/images/curiositiz_png_blc_rvb_white.png") }}" alt=""></a>
        </div>
        <nav>
            <ul class="sidebar-list">
                <li class="sidebar-item">
                    <a class="sidebar-button" href="{{ route('home') }}">Accueil</a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-button" href="{{ route('about') }}">Qui sommes nous ?</a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-button" href="{{ route('sheet.index') }}">Bons plans</a>
                </li>
            </ul>
            <hr class="sidebar-divider-nav">

            @guest
                <ul class="sidebar-list">
                    <li class="sidebar-item"><a class="sidebar-button-disabled" href="#">Mes réservations</a></li>
                    <li class="sidebar-item"><a class="sidebar-button-disabled" href="#">Créer un atelier</a></li>
                    <li class="sidebar-item"><a class="sidebar-button-disabled" href="#">Mes ateliers publiés</a></li>
                </ul>
                <hr class="sidebar-divider-nav">
                <ul class="sidebar-list">
                    <li class="sidebar-item"><a class="sidebar-button-disabled" href="#">Nous contacter</a></li>
                    <hr class="sidebar-divider-nav">
                    <li class="sidebar-item"><a href="{{ route('login') }}" class="sidebar-button">Connexion</a></li>
                </ul>
            @endguest

            @auth
                <ul class="sidebar-list">
                    <li class="sidebar-item">
                        <a class="sidebar-button" href="{{ route('workshop.next', ['slug' => Auth::user()->slug]) }}">Mes réservations</a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-button" href="{{ route('workshop.create') }}">Créer un atelier</a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-button" href="{{ route('workshop.mine', ['slug' => Auth::user()->slug]) }}">Mes ateliers publiés</a>
                    </li>
                </ul>
                <hr class="sidebar-divider-nav">
                <ul class="sidebar-list">
                    <li class="sidebar-item">
                        <a class="sidebar-button" href="{{ route('user.edit', Auth::user()->id) }}">Mon profil</a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-button" href="{{ route('contact') }}">Nous contacter</a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-button" href="{{ asset("/pdf/cgu/CGU.pdf") }}" target="_blank">Mentions légales - CGU</a>
                    </li>
                    <hr class="sidebar-divider-nav">
                    @if(Auth::user()->isAdmin())
                        <li class="sidebar-item">
                            <a class="sidebar-button" href="{{ route('admin') }}">Administration</a>
                        </li>
                    @endif
                    <li class="sidebar-item">
                        <a class="sidebar-button" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Déconnexion</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            @endauth
        </nav>
    </div>

    <!-- Logout Modal -->
    <div class="modal fade" id="LogoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content text-center">
                <div class="modal-body">
                    <p class="modal-info">Etes vous sûre de vouloir vous deconnectez ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Non</button>
                    <button type="button" class="btn btn-primary">Oui</button>
                </div>
            </div>
        </div>
    </div>

@show

@auth
    @if(Auth::user()->city == [] && Auth::user()->postal == [] && Auth::user()->phone == [])
        <div class="container d-flex justify-content-center">
            <div class="alert alert-danger alert-update-profile" role="alert">
                <a href="{{ url('user/'.Auth::user()->slug.'/edit') }}"><i class="fas fa-exclamation-triangle"></i> Vous devez finaliser votre profil</a>
            </div>
        </div>
    @endif
@endauth

@yield('content')

<!-- Scripts -->
<script></script>
</body>
</html>
