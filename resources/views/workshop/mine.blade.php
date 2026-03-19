@extends('layouts.app')

@section('content')
    <div class="site-content">
        <div class="container">
            <h3 class="content-title">Ateliers</h3>
            <hr class="content-divider">

            <div class="card offset-md-1 col-md-10">
                <div class="card-body">
                    <h3 class="content-title">Mes ateliers publiés</h3>
                    <hr class="content-divider">
                    <div class="row justify-content-center">
                        @foreach($workshops as $workshop)
                        <div class="col-md-12 @if($workshop->status < 2) card-workshop-waiting @elseif(strtotime($workshop->date) > strtotime(date('Y/m/d')))card-workshop @else card-workshop-inactive @endif">
                            <div class="card-important-message">En attente de validation de la part d'un administrateur</div>
                            <div class="row pl-1 pr-1">
                                @if($workshop->picture)
                                    <div class="col"
                                         style="background-image: url('{{asset('/images/workshops/'.$workshop->picture)}}'); background-repeat: no-repeat; background-position: center; background-size: contain;">

                                    </div>
                                @else
                                    <div class="col" style="@if($workshop->status > 1) background-color: gray; @endif"></div>
                                @endif
                                {{------------------------------------------ DESKTOP --------------------------------------------------------------------------}}
                                <div class="col-9 pt-1 pb-1 d-none d-md-block">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card-workshop-title">
                                                <a href="{{ route("workshop.show", ["slug" => $workshop->slug]) }}">{{ $workshop->name }}</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row pt-3">
                                        <div class="col-6">
                                            {{--TRANCHE D'AGE DE L'ATELIER--}}
                                            @if($workshop->age_mini == 1)
                                                <div>{{ $workshop->age_mini }} an
                                                    - {{ $workshop->age_maxi }} ans
                                                </div>
                                            @else
                                                <div>{{ $workshop->age_mini }} ans
                                                    - {{ $workshop->age_maxi }} ans
                                                </div>
                                            @endif

                                            {{--PLACE RESTANTES DANS L'ATELIER--}}
                                            @if($workshop->effectif_max > 0)
                                                <div>{{ $workshop->effectif_max}} places restantes</div>
                                            @else
                                                <div> Complet</div>
                                            @endif

                                            <div>{{ $workshop->maximum - $workshop->effectif_max}}
                                                personnes inscrites
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div>{{ $workshop->begining}} - {{ $workshop->end }}</div>
                                            <div> {{ $workshop->date->format('d/m/Y') }} </div>
                                            <div> {{ $workshop->price }}
                                                €/personne
                                            </div>
                                            <div>{{ $workshop->city }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row pt-3">
                                        <div class="col-12">
                                            <div>{{ str_limit($workshop->description, $limit = 50, $end = '...') }}</div>
                                        </div>
                                    </div>
                                    <div class="row pt-3 pb-2">
                                        <div class="col-6">
                                            <button class="btn btn-outline-primary" style="width: 100%;" data-toggle="modal" data-target="#participantsModal{{ $workshop->id }}">
                                                Participants
                                            </button>
                                        </div>
                                        <div class="col-6">
                                            <button class="btn btn-danger" data-toggle="modal" data-target="#cancelModal{{ $workshop->id }}">Annuler</button>
                                        </div>
                                    </div>
                                </div>
                                {{------------------------------------------MOBILE------------------------------------------------}}
                                <div class="col-8 pt-1 pb-1 d-sm-block d-md-none">
                                    <div class="row">
                                        <div class="col">
                                            <div class="card-workshop-title">
                                                {{ $workshop->name }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            {{--TRANCHE D'AGE DE L'ATELIER--}}
                                            @if($workshop->age_mini == 1)
                                                <div>{{ $workshop->age_mini }} an
                                                    - {{ $workshop->age_maxi }} ans
                                                </div>
                                            @else
                                                <div>{{ $workshop->age_mini }} ans
                                                    - {{ $workshop->age_maxi }} ans
                                                </div>
                                            @endif

                                            {{--PLACE RESTANTES DANS L'ATELIER--}}
                                            @if($workshop->effectif_max > 0)
                                                <div>{{ $workshop->effectif_max}} places restantes</div>
                                            @else
                                                <div> Complet</div>
                                            @endif
                                            <div>{{ $workshop->begining}} - {{ $workshop->end }}</div>
                                            <div> {{ $workshop->date->format('d/m/Y') }}</div>
                                            <div> {{ $workshop->city }} </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 pt-2">
                                            <button class="btn btn-outline-primary mb-1" data-toggle="modal" data-target="#participantsModal{{ $workshop->id }}">
                                                Participants
                                            </button>
                                        </div>

                                        <div class="col">
                                            <button class="btn btn-danger" data-toggle="modal" data-target="#cancelModal{{ $workshop->id }}">Annuler</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="participantsModal{{ $workshop->id }}" tabindex="-1" role="dialog"
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
                                                <li class="list-group-item">{{ $participation->user->firstname }} {{ $participation->user->lastname }} ({{ $participation->participants }} @if($participation->participants === 1) enfant) @else  enfants) @endif</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <div class="modal fade" id="cancelModal{{ $workshop->id }}" tabindex="-1" role="dialog" aria-labelledby="cancelModalTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="cancelModalLongTitle">Etes-vous certain d'annuler l'atelier ?</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="mt-3">
                                        <a href="{{ route('workshop.delete', ["id"=>$workshop->id]) }}"
                                                class="btn btn-outline-danger">Oui</a>

                                        <button type="button" class="btn btn-outline-dark ml-4" data-dismiss="modal" aria-label="Close">
                                           Non
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <div>
                            {{ $workshops->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
