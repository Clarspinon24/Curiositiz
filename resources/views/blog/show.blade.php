@extends('layouts.web')

@section('navbar')
    <?php $navbar = "light"; ?>
    <!-- Header Section -->
    <header class="header-light">
        <!-- Navbar Light -->
        <nav class="navbar navbar-expand-lg navbar-light py-4 text-center">
            @parent
        </nav>
        @section('logo', asset('images/logo_rasberry.svg'))
    </header>
@endsection


@section('content')
    <section class="section-article">
        <div class="container">
            <article class="">
                <h3 class="article-title">{{$article->title}}</h3>
                <p class="article-subtitle">{{$article->user->name}} | {{$article->created_at}}</p>
                <img class="article-img" src="{{ asset('images/articles/'.$article->image) }}" alt="">
                <p class="article-text">
                    {{$article->content}}
                </p>
            </article>
        </div>
    </section>
@endsection


