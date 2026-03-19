@extends('layouts.app')

@section('content')
    <div class="site-content">
        <div class="container">
            <h3 class="content-title">PROFIL DE
                <strong class="content-strong">{{ $user->firstname }} {{ $user->lastname }}</strong></h3>
            <hr class="content-divider">

            <div class="content-form">
                <img class="rounded-circle" src="{{ $user->avatar() }}" alt="" width="150" height="150">

                <div class="row">
                    <div class="col-md-6 box-info">
                        <span>Ville</span>
                        {{ $user->city }}
                    </div>
                    <div class="col-md-6 box-info">
                        <span>Code postal</span>
                        {{ $user->postal}}
                    </div>

                    @if(Auth::user()->isFriendsWith($user))
                        <div class="col-md-6 box-info">
                            <span>Email</span>
                            {{ $user->email }}
                        </div>
                        <div class="col-md-6 box-info">
                            <span>Téléphone</span>
                            {{ $user->phone }}
                        </div>
                    @else
                        <div class="col-12 text-center">
                            @if(session('info'))
                                <div class='alert alert-info'>
                                    {{ session('info') }}
                                </div>
                            @endif
                            @if($user != Auth::user())
                                <div class="alert-warning">
                                    <p>
                                        En savoir plus sur {{ $user->firstname }} {{ $user->lastname }} ? Demandez-lui
                                        de rejoindre votre réseau !
                                    </p>
                                    <a href="{{ route('addFriend', ['slug' => $user->slug]) }}">Envoyer une invitation
                                        à {{ $user->firstname }} {{ $user->lastname }}.</a>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>


            </div>

        </div>
    </div>
@endsection
