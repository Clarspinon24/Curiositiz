@extends('layouts.app')

@section('content')
    <div class="site-content">
        <div class="container">
            <h3 class="content-title">Mon Réseau</h3>
            <hr class="content-divider">
            <div class="content-button-group mt-5">
                <a class="content-button" href="{{ route('network.search') }}">Ajouter des contacts</a>
                <a class="content-button-active" href="{{ route('network.index') }}">Mon réseau</a>
                <a class="content-button"
                   href="{{ url('/network/'.Auth::user()->slug.'/invitations') }}">Invitations ({{ count(Auth::user()->friendRequests()) }})</a>
            </div>
            <div class="row">
                @if (session('message'))
                    <div class="alert alert-warning col-12">
                        {{ session('message') }}
                    </div>
                @endif
                <!--
                <div class="col-12 col-md-3 mt-3">
                    <div class="card-deck">
                        <div class="card text-center">
                            <div class="card-body">
                                <div class="card-button-group">

                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#exampleModal">
                                        Parrainage
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                -->
                <!-- Modal -->
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

                @if(session('info'))
                    <div class='alert alert-success col-12'>
                        {{ session('info') }}
                    </div>
                @endif

                @foreach($friends as $friend)
                    <div class="col-12 col-md-3 mt-3">
                        <div class="card text-center">
                            <img class="card-profil" src="{{ $friend->avatar() }}" alt="">
                            <div class="card-body">
                                <h5 class="card-title">{{ $friend->name }}</h5>
                                <p class="card-text"></p>
                                <div class="card-button-group">
                                    <a class="card-button-outline"
                                       href="{{ route('user.show', ['slug' => $friend->slug]) }}">Profil</a>
                                    <a class="card-button-outline"
                                       href="{{ route('network.delete', ['id'=> $friend->id]) }}">Supprimer</a>
                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach
            </div>
        </div>
    </div>
@endsection
