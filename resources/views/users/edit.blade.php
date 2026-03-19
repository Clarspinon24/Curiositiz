@extends('layouts.app')

@section('content')
    <div class="site-content">
        <div class="container">
            <h3 class="content-title">PROFIL DE <strong class="content-strong">{{ $user->firstname }} {{ $user->lastname }}</strong></h3>
            <hr class="content-divider">

            <div class="content-form">
                <img class="rounded-circle" src="{{ $user->avatar() }}" alt="" width="150" height="150">
                @if(session('message'))
                    <div class='alert alert-success'>
                        {{ session('message') }}
                    </div>
                @endif
                <form enctype="multipart/form-data" method="post" action="{{ route('user.update', $slug) }}">
                    {{ csrf_field() }}
                    {{ method_field('patch') }}

                    <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }} text-center">
                        <label for="image" class="control-label">Photo de profil</label><br>
                        <input type="file" class="" name="image" id="image" value="{{ $user->image_name }}"/>
                        @if ($errors->has('image'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                        @endif
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="control-label">Email</label>
                                <input type="email" class="form-control" name="email" id="email" value="{{ $user->email }}" required/>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('postal') ? ' has-error' : '' }}">
                                <label for="postal" class="control-label">Code postal</label>
                                <input type="number" class="form-control" name="postal" id="postal" maxlength="5" placeholder="Code Postal" value="{{ $user->postal }}" required/>
                                @if ($errors->has('postal'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('postal') }}</strong>
                                    </span>
                                @endif
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                                <label for="city" class="control-label">Ville</label>
                                <input type="text" class="form-control" name="city" id="city" value="{{ $user->city }}" required/>
                                @if ($errors->has('city'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12">

                            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                <label for="phone" class="control-label">Téléphone</label>
                                <input type="text" class="form-control" name="phone" id="phone" placeholder="Téléphone" value="{{ $user->phone }}" required/>
                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    @Auth
                        @if(Auth::user()->password == true)
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Confirmation">Confirmer modifications</button>
                        @endif
                    @endauth
                    @Auth
                        @if(Auth::user()->password == [])
                            <button type="submit" class="btn btn-primary">Confirmer</button>
                        @endif
                    @endauth
                    <div class="modal fade" id="Confirmation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Confirmez les changements en indiquant votre mot de passe</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <label for="password">Mot de passe</label>
                                    <input type="password" class="form-control{{ $errors->has('password') ? ' has-error' : '' }}" name="password" id="password">
                                </div>
                                <div class="modal-footer">

                                    <button type="submit" class="btn btn-primary">Confirmer</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>

        </div>
    </div>
@endsection
