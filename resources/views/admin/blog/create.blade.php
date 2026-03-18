@extends('admin.app')

@section('content')
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('admin.blog.index') }}">Curiositiz Administration</a>
        </li>
        <li class="breadcrumb-item active">Blog</li>
    </ol>

    <h1>Création d'article</h1>



    <div class="panel-body">

        @if(session('message'))
            <div class='alert alert-success'>
                {{ session('message') }}
            </div>
        @endif

        <form class="form-horizontal" method="POST" action="{{ route('admin.blog.store') }}" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="form-group">
                <label title="title">Titre:</label>
                <input id="title" type="text" name="title" class="form-control" value="{{ old('title') }}">
            </div>

            <div class="form-group">
                <label title="content">Contenu:</label>
                <textarea name="content" id="content" cols="30" rows="10" class="form-control">{{ old('content')}}</textarea>
            </div>
            <div class="form-group">
                <label for="image" class="control-label">Image de l'article </label>
                <input type="file" class="form-control" name="image" id="image" value="{{ old('image') }}"/>
            </div>
            <input type="submit" value="Créer la fiche" class="btn btn-success">
        </form>
    </div>

@endsection
