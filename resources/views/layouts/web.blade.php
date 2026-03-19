<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-117843847-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', 'UA-117843847-1');
    </script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Curiositiz, la plateforme de garde d’enfants dédiée aux parents</title>

    <!-- A RETIRER LORS DU LANCEMENT  -->
    <meta name="robots" content="noindex, nofollow">
    <!--  ---   -->

    @vite(['resources/assets/sass/main.scss', 'resources/assets/js/main.js'])
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Montserrat|Poppins" rel="stylesheet">

    <meta name="description" content="Curiositiz est une plateforme de garde d’enfants créée par des parents pour des parents. Créez votre réseau de confiance et profitez d’ateliers variés !">
    <meta name="keywords" content="curiositiz, enfants, kids, partage, garde, réseau, ateliers">

    <!-- SEO !-->
    <meta name='url' content='http://curiositiz.com/'>
    <link rel="canonical" href="http://curiositiz.com/"/>
    <meta name='identifier-URL' content='http://curiositiz.com/'>
    <meta property="og:site_name" content="Curiositiz, la plateforme de garde d’enfants dédiée aux parents"/>
    <meta property="og:type" content="website"/>
    <meta property="og:image" content="http://curiositiz.com/{{ asset('images/favicon/apple-touch-icon.png') }}">
    <meta property="og:image:width" content="200"/>
    <meta property="og:image:height" content="200"/>
    <meta property="og:url" content="http://curiositiz.com/"/>
    <meta property="og:title" content="Curiositiz"/>
    <meta property="og:description" content="Curiositiz est une plateforme de garde d’enfants créée par des parents pour des parents. Créez votre réseau de confiance et profitez d’ateliers variés !"/>

    <link rel="icon" type="image/png" href="{{ asset('images/favicon/favicon-32x32.png?v=2') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('images/favicon/site.webmanifest') }}">
    <link rel="mask-icon" href="{{ asset('images/favicon/safari-pinned-tab.svg') }}" color="#B24592">
    <meta name="msapplication-TileColor" content="#B24592">
    <meta name="theme-color" content="#B24592">
</head>

<body>

@section('navbar')
    <div class="container-fluid">

        <a class="navbar-brand mb-3" href="{{ url('/') }}">
            <img src="@section('logo')@show" alt="" width="100"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ url('/') }}">Accueil
                        <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('blog.index') }}">Actualités</a>
                </li>

            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="https://www.facebook.com/Kambooroo-145217886311960/" target="_blank"><i class="fab fa-facebook-square"></i></a>
                </li>
                <!--
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fab fa-twitter"></i></a>
                </li>
                -->
                <li class="nav-item">
                    <a class="nav-link" href="https://www.instagram.com/kambooroo/" target="_blank"><i class="fab fa-instagram"></i></a>
                </li>

                @if (Route::has('login'))
                    @auth
                        <li class="nav-item">
                            <a class="btn-nav btn nav-btn @if($navbar === "light") nav-btn-light @endif" href="{{ route('home') }}">Dashboard</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="btn-nav btn nav-btn @if($navbar === "light") nav-btn-light @endif" href="{{ route('register') }}">S'inscrire</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn-nav btn nav-btn @if($navbar === "light") nav-btn-light @endif" href="{{ route('login') }}">Se connecter</a>
                        </li>
                    @endauth
                @endif

            </ul>
        </div>
    </div>
@show

@yield('content')


<footer class="bg-light py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h4>Profitez gratuitement des services de Curiositiz</h4>
                <p>Inscrivez-vous dès maintenant pour être les premiers à recevoir gratuitement les fiches conseils et être informés de la sortie du tout noueau site de Curiositiz !</p>

                <!-- Begin MailChimp Signup Form -->
                <div id="mc_embed_signup">
                    <form action="https://kambooroo.us18.list-manage.com/subscribe/post?u=93d769cdbdf6574e521397ebc&amp;id=315f0b43b1" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="form-inline validate" target="_blank" novalidate>
                        <div id="mc_embed_signup_scroll">
                            <div class="row">
                                <div class="col-md-8 col-xm-6">
                                    <input type="email" value="" name="EMAIL" class="email form-control form-control-sm" id="mce-EMAIL" placeholder="Votre e-mail" style="width: 100%" required>
                                </div>
                                <div class="col-md-4 col-xm-6">
                                    <div style="position: absolute; left: -5000px;" aria-hidden="true">
                                        <input type="text" name="b_93d769cdbdf6574e521397ebc_315f0b43b1" tabindex="-1" value="">
                                    </div>
                                    <div class="clear">
                                        <input type="submit" value="S'abonner" name="subscribe" id="mc-embedded-subscribe" class="btn btn-primary ">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!--End mc_embed_signup-->

            </div>
            <div class="col-md-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="#">+33 66 43 21 43 12</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/cdn-cgi/l/email-protection#aac9c5c4decbc9deeac9dfd8c3c5d9c3dec3d084c9c5c7"><span class="__cf_email__" data-cfemail="7c1f1312081d1f083c1f090e15130f15081506521f1311">[email&#160;protected]</span></a>
                    </li>
                </ul>
            </div>
            <div class="col-md-2">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="https://www.facebook.com/Kambooroo-145217886311960/" target="_blank">Facebook</a>
                    </li>
                    <!--
                    <li class="nav-item">
                        <a class="nav-link" href="#">Twitter</a>
                    </li>
                    -->
                    <li class="nav-item">
                        <a class="nav-link" href="https://www.instagram.com/kambooroo/" target="_blank">Instagram</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="/cdn-cgi/l/email-protection#a2c1cdccd6c3c1d6e2c1d7d0cbcdd1cbd6cbd88cc1cdcf">Nous contacter</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('blog.index') }}">Actualités</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Se connecter</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>
<section class="footer-down text-light py-2">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                Copyright (c) Curiositiz 2020
            </div>
        </div>
    </div>
</section>

<!-- Scripts -->
<script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezG