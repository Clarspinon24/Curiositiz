@extends('layouts.app')

@section('content')
    <div class="well">
        <a href="{{ route('sheet.index')}}" class="btn btn-default">Back to articles</a>
        <h1>{{$sheet->title}}</h1>
        <p>{{$sheet->content}}</p>
        <hr>
        <small>{{$sheet->created_at}}</small>
        <a href="{{ route('sheet.pdf',$sheet->id)}}" class="btn btn-primary">Télècharger l'article</a>
    </div>
@endsection
