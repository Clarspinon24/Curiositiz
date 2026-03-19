@extends('admin.app')

@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('admin') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('admin.sheet.index') }}">Bons plans</a>
        </li>
        <li class="breadcrumb-item active">Modification</li>
    </ol>

    <div class="panel-body">
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        <hr />
        <h2>Modifier un bon plan</h2>
        <form class="form-horizontal" method="POST" action="{{ route('admin.sheet.update' ,$sheet->id) }}">
            {{ csrf_field() }}
            {{ method_field('patch') }}

            <div class="form-group">
                <label name="title">Titre :</label>
                <input id="title" type="text" name="title" class="form-control" value="{{$sheet->title }}">
            </div>
            <div class="form-group">
                <label name="content">Age :</label>
                <select name="age_range">
                    <option value="{{ $sheet->age_range }}">{{ $sheet->ageRange() }} (actuelle)</option>
                    <option value="1">0-3 ans</option>
                    <option value="2">3-6 ans</option>
                    <option value="3">6-12 ans</option>
                    <option value="4">12-14 ans</option>
                    <option value="5">0-99 ans</option>
                </select>
            </div>
            <div class="form-group">
                <label name="content">Contenu :</label>
                <input id="content" type="text" name="content" class="form-control" value="{{ $sheet->content}}">
            </div>
            <div class="form-group">
                <label for="image" class="control-label">Image</label>
                <input type="file" class="form-control" name="image" id="image" value="{{ $sheet->image_name}}"/>
            </div>
            <div class="form-group">
                <label for="image" class="control-label">PDF</label>
                <input type="file" class="form-control" name="file_name" id="file_name" value="{{ $sheet->file_name }}"/>
            </div>
            <input type="submit" value="Modifier le bon plan" class="btn btn-success">
        </form>
    </div>
@endsection
