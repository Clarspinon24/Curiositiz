@extends('admin.app')

@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('admin') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('admin.user.index') }}">Utilisateurs</a>
        </li>
        <li class="breadcrumb-item active">Modification</li>
    </ol>

    <div class="panel-body">
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        <hr>
        <h2 class="content-title">Profil de
            <strong class="content-strong">{{ $user->firstname }} {{ $user->lastname }}</strong></h2>
        <div class="content-form">
            <img class="rounded-circle" src="{{ $user->avatar() }}" alt="" width="150" height="150">
            <form enctype="multipart/form-data" method="post" action="{{ route('admin.user.update', $user->id) }}">
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
                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
                            <label for="firstname" class="control-label">Prénom</label>
                            <input type="text" class="form-control" name="firstname" id="firstname" placeholder="Prénom" value="{{ $user->firstname }}" required/>
                            @if ($errors->has('fistname'))
                                <span class="help-block">
                                <strong>{{ $errors->first('firstname') }}</strong>
                            </span>
                            @endif
                        </div>

                    </div>

                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
                            <label for="lastname" class="control-label">Nom</label>
                            <input type="text" class="form-control" name="lastname" id="lastname" value="{{ $user->lastname }}" required/>
                            @if ($errors->has('lastname'))
                                <span class="help-block">
                                <strong>{{ $errors->first('lastname') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
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
                <button type="submit" class="btn btn-primary">Confirmer</button>
            </form>
        </div>
    </div>
@endsection
