@extends('admin.app')

@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('admin') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Notations</li>
    </ol>

    <div class="panel-body">
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        <hr>
        <h2>Liste des notations</h2>
        <p class="text-muted">Les notations sont ajoutées automatiquement par les utilisateurs.</p>

        <div class="table-responsive">
            <table class="table table-striped table-bordered table-sm">
                <tr>
                    <th>Status</th>
                    <th>Participant</th>
                    <th>Atelier</th>
                    <th>Organisateur</th>
                    <th>Note</th>
                    <th>Commentaire</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
                @if(count($rates) > 0)
                    @foreach($rates as $rate)
                        <tr>
                            <td>
                                @if($rate->status === 1)
                                    <span class="badge badge-success">Valide</span>
                                @else
                                    <span class="badge badge-danger">Annulé</span>
                                @endif
                            </td>
                            <td>
                                @if($rate->user)
                                    <a href="{{ route('admin.user.show', $rate->user->id) }}">
                                        {{ $rate->user->name }} (#{{ $rate->user->id }})
                                    </a>
                                @else
                                    --
                                @endif
                            </td>
                            <td>
                                @if($rate->workshop)
                                    <a href="{{ route('admin.workshop.show', $rate->workshop->slug) }}">
                                        {{ $rate->workshop->name }} (#{{ $rate->workshop->id }})
                                    </a>
                                @else
                                    --
                                @endif
                            </td>
                            <td>
                                @if($rate->workshop && $rate->workshop->user)
                                    <a href="{{ route('admin.user.show', $rate->workshop->user->id) }}">
                                        {{ $rate->workshop->user->name }} (#{{ $rate->workshop->user->id }})
                                    </a>
                                @else
                                    --
                                @endif
                            </td>
                            <td>
                                @for($i = 1; $i <= 5; $i++)
                                    {{ $i <= $rate->rate ? '★' : '☆' }}
                                @endfor
                                ({{ $rate->rate }}/5)
                            </td>
                            <td>{{ $rate->comment ?? '--' }}</td>
                            <td>{{ $rate->created_at->format('d/m/Y') }}</td>
                            <td>
                                @if($rate->status === 1)
                                    <a class="btn btn-danger btn-sm d-inline-block mr-2"
                                       href="{{ route('admin.rate.status', $rate->id) }}">
                                        Annuler
                                    </a>
                                @else
                                    <a class="btn btn-success btn-sm d-inline-block mr-2"
                                       href="{{ route('admin.rate.status', $rate->id) }}">
                                        Rétablir
                                    </a>
                                @endif
                                <form action="{{ route('admin.rate.destroy', $rate->id) }}"
                                      method="POST" style="display:inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-dark"
                                            onclick="return confirm('Supprimer cet avis ?')">
                                        Supprimer
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="8" class="text-center">Aucune notation pour le moment.</td>
                    </tr>
                @endif
            </table>
        </div>
        {{ $rates->links() }}
    </div>
@endsection