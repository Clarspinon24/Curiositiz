@extends('admin.app')

@section('content')
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('admin.blog.index') }}">Curiositiz Administration</a>
        </li>
        <li class="breadcrumb-item active">Blog</li>
    </ol>


    <!-- Content -->
    <div class="panel-body">
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <a href="{{ route('admin.blog.create')}}" class="btn btn-primary">Ajouter un article</a>
    <hr>
    @if(count($articles) > 0)

        <table class="table table-striped table-responsive">
            <tr>
                <th>Liste des articles</th>
                <th></th>
                <th></th>
            </tr>
            @foreach($articles as $article)
                <tr>
                    <td>{{$article->title}}</td>
                    <td><a class="btn btn-primary" href="{{ route('admin.blog.edit', $article->id)}}">Modifier</a></td>
                    <td>
                        <form action="{{ route('admin.blog.destroy', $article->id)}}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('delete') }}
                            <button class="btn btn-danger">Supprimer</button>
                        </form></td>
                </tr>
            @endforeach
        </table>

    @else
        <p>Pas d'article pour le moment</p>
        @endif
        </div>
@endsection

