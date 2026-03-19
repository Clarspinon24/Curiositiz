@extends('admin.app')

@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('admin') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('admin.rate.index') }}">Notations</a>
        </li>
        <li class="breadcrumb-item active">Ajout</li>
    </ol>

    <div class="panel-body">
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <hr />
        <h2>Ajout d'une notation</h2>

        <form class="form-horizontal" method="POST" action="{{ route('admin.rate.store') }}" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="form-group">
                <label for="workshop_id">ID de l'atelier :</label>
                <input id="workshop_id" name="workshop_id" type="number" class="form-control" value="{{ old('workshop_id')}}">
            </div>

            <div class="form-group">
                <label for="rate">Note :</label>
                <select name="rate">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>

            <div class="form-group">
                <label for="user_id">ID du participant :</label>
                <input id="user_id" name="user_id" type="number" class="form-control" value="{{ old('user_id')}}">
            </div>

            <input type="submit" value="Ajouter la note" class="btn btn-success">
        </form>
    </div>
@endsection
