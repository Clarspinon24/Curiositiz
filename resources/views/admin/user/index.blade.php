@extends('admin.app')

@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('admin') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Utilisateurs</li>
    </ol>

    <div class="panel-body">
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        <hr>
        @if(count($users) > 0)
          <h2>Liste des utilisateurs</h2>
          <div class="table-responsive">
            <table class="table table-striped table-bordered table-sm">
                <tr>
                    <th>Nom</th>
                    <th>Actions</th>
                </tr>
                @foreach($users as $user)
                    <tr>
                        <td style="width: 70%">{{ $user->name }} (#{{$user->id}})</td>
                        <td>
                            <a class="btn btn-warning btn-sm d-inline-block" href="{{ route('admin.user.show', $user->id) }}">Afficher</a>
                            <a class="btn btn-primary btn-sm d-inline-block ml-2" href="{{ route('admin.user.edit', $user->id)}}">Modifier</a>
                            <form action="{{ route('admin.user.destroy', $user->id)}}" method="POST" class="d-inline-block ml-2">
                                {{ csrf_field() }}
                                {{ method_field('delete') }}
                                <button class="btn btn-danger btn-sm d-inline-block">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
          </div>
        @else
            <p>Pas d'article pour le moment</p>
        @endif
    </div>
@endsection

