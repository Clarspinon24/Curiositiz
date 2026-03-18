@extends('layouts.app')

@section('sidebar')

@section('content')

    <div class="site-content">
        {{--<div class="wrapper">--}}
        <div class="container">
        {{-- <!-- Left panel - Content -->
        <div class="leftpanel text-center">
            <h3 class="text-light">Bienvenue sur {{ config("app.name") }} !</h3>
            <p class="text-light">Le site collaboratif fais par des parents pour les parents.</p>
            <p class="text-light">N’attendez plus inscrivez-vous vite et venez découvrir l’univers Curiositiz</p>
            <a class="text-light mt-2" href="{{ URL::previous() }}"><i class="mr-1 fas fa-arrow-left"></i> Retour à l'accueil</a>
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
            <form class="form-section" method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}

                <div class="form-row d-flex justify-content-center">
                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-4">
                            <a href="{{url('/facebook')}}" class="btn btn-facebook"><i
                                        class="fab fa-facebook-square"></i> Facebook</a>
                        </div>
                    </div>

                    <div class="form-group">
                        {{--
                        <div class="col-md-8 col-md-offset-4">
                            <a href="{{url('/google')}}" class="btn btn-google"><i
                                        class="fab fa-google-plus-square"></i> Google +</a>
                        </div>
                        --}}
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6 {{ $errors->has('lastname') ? ' has-error' : '' }}">
                        <label for="lastname">Nom</label>
                        <input type="text" class="form-control" id="lastname" name="lastname"
                               value="{{ old('lastname') }}" placeholder="Votre nom" required autofocus>
                        @if ($errors->has('lastname'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('lastname') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <div class="form-group col-md-6 {{ $errors->has('firstname') ? ' has-error' : '' }}">
                        <label for="">Prénom</label>
                        <input type="text" class="form-control" name="firstname" value="{{ old('firstname') }}"
                               placeholder="Votre prénom" required autofocus>
                        @if ($errors->has('firstname'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('firstname') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email">E-mail</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}"
                           placeholder="Votre e-mail" required>

                    @if ($errors->has('email'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                    @endif
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6 {{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password">Mot de Passe</label>
                        <input type="password" class="form-control" id="password" placeholder="Mot de passe"
                               name="password" required>
                        @if ($errors->has('password'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="password-confirm">Confirmation</label>
                        <input type="password" class="form-control" id="password-confirm" placeholder="Mot de passe"
                               name="password_confirmation" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6 {{ $errors->has('postal') ? ' has-error' : '' }}">
                        <label for="postal">Code Postal</label>
                        <input type="text" class="form-control" pattern="[0-9]{5}" id="postal"
                               placeholder="Code Postal" name="postal" value="{{ old('postal') }}" required
                               autofocus>
                        @if ($errors->has('postal'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('postal') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <div class="form-group col-md-6 {{ $errors->has('city') ? ' has-error' : '' }}">
                        <label for="city">Ville</label>
                        <input type="text" class="form-control" id="city" placeholder="Ville" name="city"
                               value="{{ old('city') }}" required autofocus>
                        @if ($errors->has('city'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6{{ $errors->has('phone') ? ' has-error' : '' }}">
                        <label for="phone">Téléphone</label>
                        <input type="tel" class="form-control" id="phone" placeholder="Votre numéro" name="phone"
                               value="{{ old('phone') }}" required autofocus>
                        @if ($errors->has('phone'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-row mb-5">
                    <div class="form-check{{ $errors->has('cgu') ? ' has-error' : '' }} col-md-12">
                        <label for="cguCheck">CGU</label>
                        <div class="" style="padding-top: 2px;padding-left: 20px">
                            <input class="form-check-input" type="checkbox" name="cgu" value="1" id="cguCheck"
                                   required autofocus>
                            <label class="form-check-label" for="cguCheck">
                                J'accepte les
                                <a href="{{ route('legal.cgu') }}" target="_blank">Conditions Générales
                                    d'Utilisations</a>.
                            </label>
                            @if ($errors->has('cgu'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('cgu') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="submit-form-button">
                    <button type="submit" class="btn btn-primary">Inscription</button>
                    <small id="" class="form-text text-muted my-3" style="font-size: 1em;">
                        <a href="{{ route('login') }}">Vous avez déjà un compte ?</a></small>
                </div>
            </form>
        </div>

    </div>
    </div>

@endsection





