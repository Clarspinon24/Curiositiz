@extends('layouts.app')

@section('sidebar')

@section('content')

    <div class="site-content">
        {{--<div class="wrapper">--}}
        <div class="container">

            {{-- <!-- Left panel - Content -->
            <div class="leftpanel text-center">
                <h3 class="text-light">Bienvenue sur {{ config('app.name') }}</h3>
                <p class="text-light">Connectez-vous en remplissant le formulaire ci-dessous ou inscrivez-vous !</p>
                <a class="text-light mt-2" href="{{ URL::previous() }}"><i class="fas fa-arrow-left"></i> Retour à
                    l'accueil</a>
            </div>--}}


            <!-- Right panel - Content -->

                {{--<div class="rightpanel">--}}
                <div class="text-center">
                    <div class="row">
                        <div class="col-md-12 m-3 col-sm-6">
                            <h3 class="text-dark auth-title">Bienvenue sur {{ config('app.name') }} !</h3>
                            <p class="text-dark auth-subtitle">Inscrivez-vous en remplissant le formulaire ci-dessous ou connectez-vous
                                !</p>
                        </div>
                    </div>
                </div>

                @if(session('status_mail'))
                    <div class="alert alert-success">
                        {{ session('status_mail') }}
                    </div>
                @endif
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                @if (session('warning'))
                    <div class="alert alert-warning">
                        {{ session('warning') }} <br>
                    </div>
                @endif

                <form class="form-section" method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}


                    <div class="form-row d-flex justify-content-center">
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <a href="{{url('/facebook')}}" class="btn btn-facebook"><i
                                            class="fab fa-facebook-square"></i>Facebook</a>
                            </div>
                        </div>
                {{--
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <a href="{{url('/google')}}" class="btn btn-google">Google</a>
                            </div>
                        </div>
                --}}


                    </div>


                    <div class="form-row d-flex justify-content-center">
                        <div class="form-group">
                            <label style="font-weight: 700;">OU</label>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12 {{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email">E-Mail</label>
                            <input type="email" class="form-control" id="email" placeholder="Votre adresse e-mail"
                                   name="email" value="{{ old('email') }}" required autofocus>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group col-md-12 {{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password">Mot de passe</label>
                            <input type="password" class="form-control" id="password" placeholder="Votre mot de passe"
                                   name="password" required>
                            @if ($errors->has('password'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <a href="{{ route('password.request') }}">
                        Mot de passe oublié?
                    </a>
                    <div class="submit-form-button mt-4">
                        <button type="submit" class="btn btn-primary">Se connecter</button>
                        <small id="" class="form-text text-muted my-3" style="font-size: 1em;">
                            <a href="{{ route('register') }}">Vous n'avez pas de compte ?</a></small>
                    </div>
                </form>
            </div>

        </div>
    </div>

@endsection




