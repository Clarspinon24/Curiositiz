@extends('admin.app')

@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('admin') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('admin.sheet.index') }}">Bons plans</a>
        </li>
        <li class="breadcrumb-item active">Bon plan "{{$sheet->title }}"</li>
    </ol>

    <div class="panel-body">
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        <hr>
        <h2 class="content-title">Bon plan <strong>{{$sheet->title }}</strong></h2>
        <div class="content-form">
            <div class="card">
                <div class="card-block">
                    <div class="row">
                        <div class="col-12 col-lg-2 mb-3 mb-md-0">
                            <img src="{{ asset('images/sheets/'.$sheet->image) }}" alt="" class="img-responsive img-thumbnail" height="200" width="200">
                        </div>
                        <div class="col-12 col-lg-10">
                            <h4 class="card-title">Tranche d'âge</h4>
                            <p class="card-text">{{ $sheet->ageRange() }}</p>

                            <h4 class="card-title">Auteur</h4>
                            <p class="card-text">{{ $sheet->user->name }} | {{$sheet->created_at}}</p>

                            <h4 class="card-title">Contenu</h4>
                            <p class="card-text">{{ $sheet->content  }}</p>

                            <h4 class="card-title">PDF</h4>
                            <a class="card-button-outline" href="{{ asset('pdf/sheets/').'/'.$sheet->file_name }}" target="_blank">Télécharger</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
