@extends('layouts.app')
@use('App\Models\Rate')

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

                                <div class="card-title mb-0 mt-4">Adresse de l'activité</div>
                                <p>{{ $workshop->address }}, {{ $workshop->city }}</p>

                                <div class="card-title mb-0 mt-4">Prix par participant</div>
                                <p>{{ $workshop->price }} €</p>

                                <div class="card-title mb-0 mt-4">Accompagnement</div>
                                <p>@if($workshop->parent === 1) Présence obligatoire d'un adulte @else Présence non obligatoire @endif</p>

                                @auth
                                    <div class="card-title mb-0 mt-4">Participants</div>
                                    <button class="btn btn-outline-info" style="width: auto;" data-toggle="modal" data-target="#participantsModal">
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

                                <div class="card-title mb-0 mt-4">Description</div>
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
                        
                        @endif

                    @auth
                    @if($workshop->user_id !== Auth::id())
                    
                    <div class="col-md-6">
                    <a href="{{ route('chat.create', $workshop->slug) }}" class="btn btn-outline-primary w-100 m-2">
                     Contacter l'organisateur
                    </a>    
                </div>    
                    </div>
                    @endif
                    @endauth
                </div>
                </div>

                {{-- MODAL PARTICIPANTS --}}
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
                                      @if($participation->user)
                                        <li class="list-group-item">
                                            {{ $participation->user->firstname }} {{ substr($participation->user->lastname, 0, 1) }}
                                            ({{ $participation->participants }}
                                            @if($participation->participants === 1) enfant) @else enfants) @endif
                                        </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- MODAL RESERVATION --}}
                @auth
                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <form action="{{ route('workshop.participate', ['slug'=> $workshop->slug]) }}" method="POST">
                            {{ csrf_field() }}
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Inscription pour {{$workshop->name}}</h5>
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
                                        <a href="{{ route("login") }}">connecter</a> ou <a href="{{ route("register") }}">créer un compte</a>
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endguest

                {{-- SECTION AVIS --}}
                <div class="container mt-5">
                    <h4 class="content-title">Avis des participants</h4>
                    <hr class="content-divider">

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    {{-- FORMULAIRE : uniquement si l'atelier est terminé --}}
                    @auth
                        @if(strtotime($workshop->date) < strtotime(date('Y/m/d')) && !auth()->user()->isAdmin())
                            @if(!Rate::alreadyRated(auth()->id(), $workshop->id))
                                <form action="{{ route('rate.store') }}" method="POST" class="mb-4">
                                    @csrf
                                    <input type="hidden" name="workshop_id" value="{{ $workshop->id }}">

                                    <div class="form-group">
                                        <label>Votre note</label>
                                        <div class="star-rating">
                                            @for($i = 5; $i >= 1; $i--)
                                                <input type="radio" name="rate" id="star{{ $i }}" value="{{ $i }}">
                                                <label for="star{{ $i }}">&#9733;</label>
                                            @endfor
                                        </div>
                                    </div>

                                    <div class="form-group mt-3">
                                        <label for="comment">Votre commentaire (optionnel)</label>
                                        <textarea name="comment" id="comment" rows="3"
                                            class="form-control" maxlength="500"
                                            placeholder="Partagez votre expérience..."></textarea>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Envoyer mon avis</button>
                                </form>
                            @else
                                <p class="text-muted">Vous avez déjà noté cet atelier.</p>
                            @endif
                        @else
                            <p class="text-muted">Vous pourrez noter cet atelier une fois qu'il sera terminé.</p>
                        @endif
                    @endauth

                    {{-- LISTE DES AVIS --}}
                    @forelse($workshop->rates as $rate)
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <strong>{{ $rate->user->firstname }}</strong>
                                        <span class="ml-2 text-warning">
                                            @for($i = 1; $i <= 5; $i++)
                                                {{ $i <= $rate->rate ? '★' : '☆' }}
                                            @endfor
                                        </span>
                                    </div>
                                    <small class="text-muted">{{ $rate->created_at->format('d/m/Y') }}</small>
                                </div>

                                @if($rate->comment)
                                    <p class="mt-2 mb-1">{{ $rate->comment }}</p>
                                @endif

                                @auth
                                    @if(auth()->id() === $rate->user_id || auth()->user()->isAdmin())
                                        <form action="{{ route('rate.destroy', $rate->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger mt-1">
                                                Supprimer
                                            </button>
                                        </form>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    @empty
                        <p class="text-muted">Aucun avis pour le moment.</p>
                    @endforelse
                </div>

            </div>
        </div>
    </div>

    <style>
        .star-rating {
            display: flex;
            flex-direction: row-reverse;
            justify-content: flex-end;
        }
        .star-rating input { display: none; }
        .star-rating label {
            font-size: 2rem;
            color: #ccc;
            cursor: pointer;
        }
        .star-rating input:checked ~ label,
        .star-rating label:hover,
        .star-rating label:hover ~ label {
            color: #f5a623;
        }
    </style>

@endsection