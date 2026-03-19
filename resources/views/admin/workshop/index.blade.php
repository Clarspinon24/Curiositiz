@extends('admin.app')

@section('content')
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('admin') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Ateliers</li>
    </ol>
    <div class="panel-body">
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        <hr>
        @if(count($workshops) > 0)
            <h2>Liste des ateliers</h2>
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-sm">
                    <tr>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Nom</th>
                        <th>Organisateur</th>
                        <th>Note</th>
                        <th>Actions</th>
                    </tr>
                    @foreach($workshops as $workshop)
                        <tr>
                            <td>{{ $workshop->getStatus() }}</td>
                            <td>{{ $workshop->date->format('d/m/Y') }}</td>
                            <td>{{ $workshop->name }} (#{{ $workshop->id }})</td>
                            <td>{{ $workshop->user->name }}</td>
                            <td>@if($workshop->getRating() === -1) Ø @else {{ $workshop->getRating() }} @endif</td>
                            <td>
                                @if($workshop->status === 1)
                                    <a class="btn btn-success btn-sm d-inline-block mr-2" href="{{ route('admin.workshop.approve', $workshop->slug) }}">Approuver</a>
                                @else
                                @endif
                                <a class="btn btn-warning btn-sm d-inline-block" href="{{ route('admin.workshop.show', $workshop->slug) }}">Afficher</a>
                                <a class="btn btn-primary btn-sm d-inline-block ml-2" href="{{ route('admin.workshop.edit', $workshop->slug)}}">Modifier</a>
                                <form action="{{ route('admin.workshop.destroy', $workshop->id) }}" method="POST" class="d-inline-block ml-2">
                                    {{ csrf_field() }}
                                    {{ method_field('delete') }}
                                    <button class="btn btn-danger btn-sm">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        @else
            <p>Pas de garde pour le moment</p>
        @endif
    </div>
@endsection

