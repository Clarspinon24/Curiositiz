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
        @endsection

        @section('content')

            <section style="background-color: #f5f5f5;">
                <div class="container">
                    <div class="content-header">
                        <h2 class="content-title">Blog</h2>
                        <hr class="content-divider">
                    </div>

                    <div class="row">

                        @if(count($articles) > 0)

                            @foreach($articles as $article)

                                <div class="col-md-6">
                                    <!--Article Card -->
                                    <article class="">
                                        <div class="card">
                                            <img class="card-img-top" src="{{ asset('images/articles/'.$article->image) }}" alt="" height="200">
                                            <div class="card-body">
                                                <div class="card-title">
                                                    <a class="card-link" href="{{ route('blog.show', $article->id )}}">{{$article->title}}</a>
                                                </div>
                                                <p class="card-text">{{$article->content}}</p>
                                                <!--
                                                <a href="#"><i class="far fa-heart fa-2x card-icon"></i></a><span class="card-counter">93 likes</span>
                                                -->
                                                <small>{{$article->user->name}} | {{$article->created_at}}</small>
                                            </div>
                                        </div>
                                    </article>
                                </div>

                            @endforeach

                        @else

                            <p>Pas d'article pour le moment ...</p>

                        @endif


                    </div>
                    <!--
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center">
                            <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">Next</a></li>
                        </ul>
                    </nav>
                    -->
                </div>
            </section>

@endsection
