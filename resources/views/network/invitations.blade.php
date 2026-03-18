@extends('layouts.app')

@section('content')
    <div class="site-content">
        <div class="container">
            <h3 class="content-title">Mon Réseau</h3>
            <hr class="content-divider">
            <div class="content-button-group mt-5">
                <a class="content-button" href="{{ route('network.search') }}">Ajouter des contacts</a>
                <a class="content-button" href="{{ route('network.index') }}">Mon réseau</a>
                <a class="content-button-active" href="{{ url('/network/'.Auth::user()->slug.'/invitations') }}">Invitations</a>
            </div>
            <div class="row">
                <div class="col-12 col-md-3 mt-3">
                    <div class="card-deck">
                        <div class="card text-center">
                            <div class="card-body">
                                <h5 class="card-title">AJOUTER <br> DES <br> CONTACTS</h5>

                                <form action="{{ route('network.search.result') }}" method="POST" role="search">
                                    {{ csrf_field() }}
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="q" placeholder="Maëlys Dupont">
                                    </div>
                                    <button type="submit" class="content-button col-md-6 btn">Chercher</button>
                                </form>
                                <p class="card-text">ou</p>
                                <div class="card-button-group">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#exampleModal">
                                       Invitez le !
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal
                <div class="modal fade text-center" id="exampleModal" tabindex="-1" role="dialog"
                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <h5 class="modal-title" id="">Parrainer un ami</h5>
                                <hr class="content-divider">
                                <form>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Adresse E-Mail</label>
                                        <input type="email" class="form-control" id="exampleInputEmail1"
                                               aria-describedby="emailHelp" placeholder="Enter email">
                                        <small id="emailHelp" class="form-text text-muted">Invitez un de vos amis à
                                            rejoindre la plateforme
                                        </small>
                                    </div>
                                    <button class="modal-button" type="button" name="button">Envoyer</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                -->
                <div class="modal fade text-center" id="exampleModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <h5 class="modal-title" id="">Bientôt disponible ...</h5>
                                <hr class="content-divider">
                                Bientôt disponible ...
                            </div>
                        </div>
                    </div>
                </div>
                @foreach($requests as $request)
                    <div class="col-12 col-md-3 mt-3">
                        <div class="card text-center">
                            <img class="card-profil" src="{{ $request->avatar() }}" alt="">
                            <div class="card-body">
                                <h5 class="card-title">{{ $request->name }}</h5>
                                <p class="card-text"></p>
                                <div class="card-button-group">
                                    <a class="card-button-outline" href="{{ route('user.show', $request->slug) }}">Profil</a>
                                    <a class="card-button-outline"
                                       href="{{ route('Acceptfriend', ['slug'=> $request->slug]) }}">Accepter</a>
                                    <a class="card-button-outline"
                                       href="{{ route('network.delete', ['id' => $request->id]) }}">Refuser</a>
                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach
            </div>
        </div>
    </div>

@endsection
