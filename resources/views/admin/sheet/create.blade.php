@extends('admin.app')

@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('admin') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('admin.sheet.index') }}">Bons plans</a>
        </li>
        <li class="breadcrumb-item active">Création</li>
    </ol>

    <div class="panel-body">
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        <hr />
        <h2>Création d'un bon plan</h2>

        <form class="form-horizontal" method="POST" action="{{ route('admin.sheet.store') }}" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="form-group">
                <label name="title">Titre :</label>
                <input id="title" type="text" name="title" class="form-control" value="{{ old('title') }}">
            </div>
            <div class="form-group">
                <label name="content">Age :</label>

                <select name="age_range">
                    <option value="1">0-3 ans</option>
                    <option value="2">3-6 ans</option>
                    <option value="3">6-12 ans</option>
                    <option value="4">12-14 ans</option>
                    <option value="5">0-99 ans</option>
                </select>
            </div>

            <div class="form-group">
                <label name="content">Contenu :</label>
                <input id="content" type="text" name="content" class="form-control" value="{{ old('content')}}">
            </div>
            <div class="form-group">
                <label for="image" class="control-label">Image</label>
                <input type="file" class="form-control" name="image" id="image" value="{{ old('image') }}"/>
            </div>

            <div class="form-group">
                <label for="image" class="control-label">PDF</label>
                <input type="file" class="form-control" name="file_name" id="file_name" value="{{ old('file_name') }}"/>
            </div>
            <input type="submit" value="Créer le bon plan" class="btn btn-success">
        </form>
    </div>
@endsection
