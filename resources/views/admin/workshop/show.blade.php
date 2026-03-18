@extends('admin.app')

@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('admin') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('admin.workshop.index') }}">Ateliers</a>
        </li>
        <li class="breadcrumb-item active">Atelier "{{ $workshop->name }}"</li>
    </ol>

    <div class="panel-body">
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        <hr>
        <h2 class="content-title">Atelier <strong>{{ $workshop->name }} </strong></h2>
        <div class="content-form">
            <div class="card">
                <div class="card-block">
                    <div class="row">
                        <div class="col-12 col-lg-2 mb-3 mb-md-0">
                            <img src="{{ asset('/images/workshops/'.$workshop->picture) }}" alt="" class="img-responsive img-thumbnail" height="200" width="200">
                            <p class="card-text mt-3 text-center">
                                Note moyenne: @if($workshop->getRating() === -1) Ø@else{{ $workshop->getRating() }}@endif<i class="fa fa-fw fa-star"></i>
                            </p>
                        </div>
                        <div class="col-12 col-lg-10">
                            <h4 class="card-title">Tranche d'âge</h4>
                            @if($workshop->age_mini == 1)
                                 <p class="card-text">{{ $workshop->age_mini }} an - {{ $workshop->age_maxi }} ans </p>
                            @else
                                 <p class="card-text">{{ $workshop->age_mini }} ans - {{ $workshop->age_maxi }} ans </p>
                            @endif


                            <h4 class="card-title">Date</h4>
                             <p class="card-text">Le {{ $workshop->date->format('d/m/Y') }} de {{ $workshop->begining }} à {{ $workshop->end }}</p>

                            <h4 class="card-title">Type d'organisateur</h4>
                            <p class="card-text">{{ $workshop->getOrganizationType() }}</p>

                            <h4 class="card-title">Adresse de l’activité</h4>
                             <p class="card-text">{{ $workshop->address }}, {{ $workshop->city }}</p>

                            <h4 class="card-title">Prix par participant</h4>
                             <p class="card-text">{{ $workshop->price }} €</p>

                            <h4 class="card-title">Accompagnement de l’enfant</h4>
                             <p class="card-text">@if($workshop->parent === 1) Présence obligatoire d’un adulte @else Présence non obligatoire @endif </p>

                            <h4 class="card-title">Participants</h4>
                            <p class="card-text">
                                <button class="btn btn-outline-info" style="width: auto;" data-toggle="modal"data-target="#participantsModal">
                                    {{ $workshop->maximum - $workshop->effectif_max }} personnes inscrites
                                </button>
                            </p>

                            <h4 class="card-title"> Description</h4>
                            <p class="card-text">{{ $workshop->description }}</p>
                        </div>
                    </div>
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
        </div>
    </div>
@endsection
