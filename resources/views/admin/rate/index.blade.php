@extends('admin.app')

@section('content')
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('admin') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Notations</li>
    </ol>

    <!-- Content -->
    <div class="panel-body">
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        <hr>
           <h2>Liste des notations <a href="{{ route('admin.rate.create')}}" class="btn btn-success btn-sm"> <i class="fa fa-fw fa-plus"></i> Ajouter une notation</a></h2>
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-sm">
                    <tr>
                        <th>Status</th>
                        <th>Participant</th>
                        <th>Atelier</th>
                        <th>Organisateur</th>
                        <th>Note</th>
                        <th>Actions</th>
                    </tr>
                    @if(count($rates) > 0)
                        @foreach($rates as $rate)
                            <tr>
                                <td>{{ $rate->getStatus() }}</td>
                                <td><a href="{{ route('admin.user.show', $rate->user->id) }}">{{ $rate->user->name }} (#{{ $rate->user->id }})</a></td>
                                <td><a href="{{ route('admin.workshop.show', $rate->workshop->slug) }}">{{ $rate->workshop->name }} (#{{ $rate->workshop->id }})</a></td>
                                <td><a href="{{ route('admin.user.show', $rate->workshop->user->id) }}">{{ $rate->workshop->user->name }} (#{{ $rate->workshop->user->id }})</a></td>
                                <td>{{ $rate->rate }}</td>
                                <td>
                                    @if($rate->status === 1)
                                        <a class="btn btn-danger btn-sm d-inline-block mr-2" href="{{ route('admin.rate.status', $rate->id) }}">Annuler</a>
                                    @else
                                        <a class="btn btn-success btn-sm d-inline-block mr-2" href="{{ route('admin.rate.status', $rate->id) }}">Rétablir</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </table>
            </div>
    </div>
@endsection

