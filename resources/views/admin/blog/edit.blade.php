@extends('admin.app')

@section('content')
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('admin.blog.index') }}">Curiositiz Administration</a>
        </li>
        <li class="breadcrumb-item active">Blog</li>
    </ol>

    <h1>Édition de l'article</h1>


    <div class="panel-body">

        @if(session('message'))
            <div class='alert alert-success'>
                {{ session('message') }}
            </div>
        @endif

        <form class="form-horizontal" method="POST" action="{{ route('admin.blog.update' , $article->id) }}">
            {{ csrf_field() }}
            {{ method_field('patch') }}

            <div class="form-group">
                <label name="title">Titre:</label>
                <input id="title" type="text" name="title" class="form-control" value="{{ $article->title }}">
            </div>

            <div class="form-group">
                <label name="content">Contenu :</label>
                <textarea name="content" id="content" cols="30" rows="10" class="form-control">{{ $article->content}}</textarea>
            </div>
            <div class="form-group">
                <label for="image" class="control-label">Photo de la fiche </label>
                <input type="file" class="form-control" name="image" id="image" value="{{$article->image}}"/>
            </div>
            <input type="submit" value="Modifier l'article" class="btn btn-success">
        </form>
    </div>

@endsection
