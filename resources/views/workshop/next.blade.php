@extends('layouts.app')

@section('content')

    <div class="site-content">
        <div class="container pl-0 pr-0">
            <h3 class="content-title">Ateliers</h3>
            <hr class="content-divider">

            <div class="card offset-md-1 col-md-10">
                <div class="card-body pl-1 pl-md-3 pr-1 pr-md-3">
                    <h3 class="content-title">Mes réservations</h3>
                    <hr class="content-divider">
                    <div class="row justify-content-center">
                        @if(session('message'))
                            <div class='alert alert-success'>
                                {{ session('message') }}
                            </div>
                        @endif
                        @foreach($workshops as $workshop)
                            @if(strtotime($workshop->date) > strtotime(date('Y/m/d')))
                                <div class="col-md-12 card-workshop mb-1 mb-md-3">

                                        <div class="row pl-1 pr-1">
                                            @if($workshop->picture)
                                                <div class="col"
                                                     style="background-image: url('{{ asset('/images/workshops/'.$workshop->picture)}}'); background-repeat: no-repeat; background-position: center; background-size: contain;">

                                                </div>
                                            @else
                                                <div class="col" style="background-color: gray"></div>
                                            @endif
                                            {{------------------------------------------ DESKTOP --------------------------------------------------------------------------}}
                                            <div class="col-9 pt-1 pb-1 d-none d-md-block">
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="card-workshop-title">
                                                            <a href="{{ route("workshop.show", ["slug" => $workshop->slug]) }}">{{ $workshop->name }}</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row pt-3">
                                                    <div class="col-4">
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
                                                    <div class="col-4">
                                                        <div>{{ $workshop->begining}} - {{ $workshop->end }}</div>
                                                        <div> {{ $workshop->date->format('d/m/Y') }} </div>
                                                        <div>{{ $workshop->price }}
                                                            €/personne
                                                        </div>
                                                        <div>{{ $workshop->city }}
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="d-flex align-items-center" style="height: 100%;">
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
                                                    </div>
                                                </div>
                                                <div class="row pt-3">
                                                    <div class="col-12">
                                                        {{ str_limit($workshop->description, $limit = 50, $end = '...') }}
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col">
                                                        <a class="btn btn-primary" href="{{ route("workshop.show", ["slug" => $workshop->slug]) }}">Consulter</a>
                                                        <button class="btn btn-danger ml-2" data-toggle="modal" data-target="#cancelModal{{ $workshop->id }}">Annuler</button>
                                                    </div>
                                                </div>
                                            </div>
                                            {{------------------------------------------MOBILE------------------------------------------------}}
                                            <div class="col-8 pt-1 pb-1 d-sm-block d-md-none">
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="card-workshop-title">
                                                            <a href="{{ route("workshop.show", ["slug" => $workshop->slug]) }}">{{ $workshop->name }}</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-8">
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

                                                        <div>{{ $workshop->begining}} - {{ $workshop->end }}</div>
                                                        <div>{{ $workshop->date->format('d/m/Y') }}</div>
                                                        <div>{{ $workshop->city }}
                                                            {{--PLACE RESTANTES DANS L'ATELIER--}}
                                                            @if($workshop->effectif_max > 0)
                                                                <div>{{ $workshop->effectif_max}} places restantes
                                                                </div>
                                                            @else
                                                                <div> Complet</div>
                                                            @endif
                                                        </div>

                                                    </div>
                                                    <div class="col-4 pl-0">
                                                        <div class="d-flex align-items-center" style="height: 100%;">
                                                            <div class="text-center">
                                                                <img src="{{ $workshop->user->avatar() }}" alt="" class="img-responsive" height="20" width="20">

                                                                <div class="mt-2">
                                                                    {{ $workshop->user->firstname }} <br>
                                                                    @if($workshop->user->getRating() === -1)

                                                                    @else
                                                                        {{ $workshop->user->getRating() }}/5 <i class="fa fa-fw fa-star"></i>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <div class="col-12 p-0 d-md-none">
                                        <div class="row mt-2 mb-2">
                                            <div class="col-6 d-flex justify-content-center">
                                                <a class="btn btn-primary" style="width:100%;padding-left:0!important;padding-right:0!important;" href="{{ route("workshop.show", ["slug" => $workshop->slug]) }}">Consulter</a>
                                            </div>
                                            <div class="col-6 d-flex justify-content-center">
                                                <button style="width:100%;color: white !important;padding-left:0!important;padding-right:0!important;" class="btn btn-danger" data-toggle="modal" data-target="#cancelModal{{ $workshop->id }}">Annuler</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @else

                            @endif

                                <div class="modal fade" id="cancelModal{{ $workshop->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="cancelModalTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="cancelModalLongTitle">Etes-vous certain d'annuler votre réservation ?</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="mt-3">
                                                <div class="row">
                                                    <div class="col-6 d-flex justify-content-center">
                                                        <button type="button" class="btn btn-primary" style="width:100%;" data-dismiss="modal" aria-label="Close">
                                                            Retour
                                                        </button>
                                                    </div>
                                                    <div class="col-6 d-flex justify-content-center">
                                                        <a href="{{ route('workshop.deleteParticipation', ["id"=>$workshop->id]) }}" class="btn btn-danger" style="width:100%;color: white !important;padding-left: 0 !important;padding-right: 0 !important;">Confirmer</a>
                                                    </div>
                                                </div>
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


@endsection
