@extends('layouts.app')

@section('content')

    <div class="site-content">
        <div class="container">
            <h3 class="content-title">Ateliers</h3>
            <hr class="content-divider">

            <div class="row">
                <div class="card offset-md-1 col-md-10">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-3">
                            </div>
                            <div class="offset-md-1 col-md-4 content-title">
                                <h3>{{ $workshop->name }}</h3>
                            </div>
                        </div>
                        <hr class="content-divider">
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card-title mb-0">Tranche d'âge</div>
                                @if($workshop->age_mini == 1)
                                    <p>{{ $workshop->age_mini }} an - {{ $workshop->age_maxi }} ans </p>
                                @else
                                    <p>{{ $workshop->age_mini }} ans - {{ $workshop->age_maxi }} ans </p>
                                @endif

                                <div class="card-title mb-0 mt-4">Date</div>
                                <p>Le {{ $workshop->date->format('d/m/Y') }} de {{ $workshop->begining }} à {{ $workshop->end }}</p>

                                <div class="card-title mb-0 mt-4">Adresse de l’activité</div>
                                <p>{{ $workshop->address }}, {{ $workshop->city }}</p>

                                <div class="card-title mb-0 mt-4">Prix par participant</div>
                                <p>{{ $workshop->price }} €</p>

                                <div class="card-title mb-0 mt-4">Accompagnement</div>
                                <p>@if($workshop->parent === 1) Présence obligatoire d’un adulte @else Présence non obligatoire @endif </p>

                                @auth
                                    <div class="card-title mb-0 mt-4">Participants</div>
                                    <button class="btn btn-outline-info" style="width: auto;" data-toggle="modal"data-target="#participantsModal">
                                        {{ $workshop->maximum - $workshop->effectif_max }} personnes inscrites
                                    </button>
                                @endauth
                            </div>
                            <div class="col-md-6">
                                <div class="card-title mb-0 mt-4 mt-md-0">Organisateur</div>
                                <div class="d-flex align-items-center">
                                    <div>
                                        <img src="{{ $workshop->user->avatar() }}" alt="" class="img-responsive" height="60" width="60">
                                    </div>
                                    <div class="ml-2">
                                        {{ $workshop->user->firstname }} <br>
                                        @if($workshop->user->getRating() === -1)

                                        @else
                                            {{ $workshop->user->getRating() }}/5 <i class="fa fa-fw fa-star"></i>
                                        @endif
                                    </div>
                                </div>

                                <div class="card-title mb-0 mt-4">Type d'organisateur</div>
                                <p>{{ $workshop->getOrganizationType() }}</p>

                                <div class="card-title mb-0 mt-4"> Description</div>
                                <p>{{ $workshop->description }}</p>
                            </div>
                        </div>
                        @if(strtotime($workshop->date) > strtotime(date('Y/m/d')) and $workshop->effectif_max > 0)
                            <div class="row justify-content-center mt-4">
                                <div class="col-md-6">
                                    <button class="btn card-button-outline" data-toggle="modal"
                                            data-target="#exampleModalCenter">Réserver
                                    </button>
                                </div>
                            </div>
                        @else
                        @endif
                    </div>
                </div>


                <div class="modal fade" id="participantsModal" tabindex="-1" role="dialog"
                        aria-labelledby="participantsModalTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="participantsModalLongTitle">Liste des participants</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="mt-3">
                                <ul class="list-group">
                                    @foreach($workshop->participations as $participation)
                                        <li class="list-group-item">{{ $participation->user->firstname }} {{ substr($participation->user->lastname, 0, 1) }} ({{ $participation->participants }} @if($participation->participants === 1) enfant) @else  enfants) @endif</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>


                @auth
                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <form action="{{ route('workshop.participate', ['id'=> $workshop->id]) }}" method="POST">
                            {{ csrf_field() }}
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Inscription
                                            pour {{$workshop->name}}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="participants">Nombre de participants</label>
                                            <input type="number" id="participants" name="participants"
                                                   max="{{ $workshop->effectif_max }}" min="0" class="form-control">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Confirmer</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                @endauth
                @guest
                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Pour participer vous devez vous
                                        <a href="{{ route("login") }}">connecter</a> ou <a
                                                href="{{ route("register") }}">créer un compte</a></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endguest
            </div>
        </div>
    </div>

@endsection
