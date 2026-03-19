@extends('admin.app')

@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('admin') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('admin.user.index') }}">Utilisateurs</a>
        </li>
        <li class="breadcrumb-item active">Profil de {{ $user->firstname }} {{ $user->lastname }}</li>
    </ol>

    <div class="panel-body">
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        <hr>
        <h2 class="content-title">Profil de <strong>{{ $user->firstname }} {{ $user->lastname }}</strong></h2>
        <div class="content-form">
            <div class="card">
                <div class="card-block">
                    <div class="row">
                        <div class="col-12 col-lg-2 mb-3 mb-md-0">
                            @if($user->image_name !== 'defaul.png')
                                <img src="{{ $user->avatar() }}" alt="" class="img-responsive img-thumbnail" height="200" width="200">
                            @endif
                            <p class="card-text mt-3 text-center">
                                Note moyenne: @if($user->getRating() === -1) Ø@else{{ $user->getRating() }}@endif<i class="fa fa-fw fa-star"></i>
                            </p>
                        </div>
                        <div class="col-12 col-lg-10">
                            <h4 class="card-title">Nom</h4>
                            <p class="card-text">{{ $user->firstname }} {{ $user->lastname }} ({{ $user->name }})</p>

                            <h4 class="card-title">Téléphone</h4>
                            <p class="card-text">{{ $user->phone}}</p>

                            <h4 class="card-title">Email</h4>
                            <p class="card-text">{{ $user->email}}</p>

                            <h4 class="card-title">Ville</h4>
                            <p class="card-text">{{ $user->city}} ({{ $user->postal}})</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
