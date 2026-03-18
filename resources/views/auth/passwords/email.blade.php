@extends('layouts.app')

@section('sidebar')
@endsection

@section('content')

    <div class="page">
        <div class="wrapper">

            <!-- Left panel - Content -->
            <div class="leftpanel text-center">
                <h3 class="text-light">Réinitialisation du mot de passe</h3>
                <p class="text-light"></p>
                <a class="text-light mt-2" href="{{ url('/') }}"><i class="fas fa-arrow-left"></i> Retour à l'accueil</a>
            </div>

            <!-- Right panel - Content -->

            <div class="rightpanel">
                <div class="mobile-display text-center">
                    <h3 class="text-dark">Réinitialisation du mot de passe</h3>
                    <p class="text-dark"></p>
                </div>

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-md-6 control-label">E-mail</label>

                        <div class="col-md-12">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Envoyer le lien de réinitialisation par email
                            </button>
                        </div>
                    </div>
                </form>


            </div>

        </div>
    </div>

@endsection


