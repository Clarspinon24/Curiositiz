@extends('layouts.app')
@section('content')

    <div class="site-content">
        <div class="container">
            <h3 class="content-title">NOUS CONTACTER</h3>
            <hr class="content-divider">


            <div class="content-form">
                @if(session('message'))
                    <div class='alert alert-success'>
                        {{ session('message') }}
                    </div>
                @endif
                <form class="" method="POST" action="{{ route('contact.send') }}">
                    {{ csrf_field() }}

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="firstname">Prénom</label>
                                <input class="form-control" type="text" maxlength="5" name="firstname" id="firstname" placeholder="Votre Prénom" value="{{ Auth::user()->firstname }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="lastname">Nom</label>
                                <input class="form-control" type="text" placeholder="Votre Nom" id="lastname" name="lastname" value="{{ Auth::user()->lastname }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">E-Mail</label>
                                <input class="form-control" type="email" maxlength="5" placeholder="e-mail" id="email" name="email" value="{{ Auth::user()->email }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="subject">Sujet</label>
                                <input class="form-control" type="text" name="subject" value="{{ old('subject') }}" placeholder="Votre Sujet" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Votre Message</label>
                                <textarea class="form-control" rows="10" cols="auto" placeholder="Votre Message" id="message" name="message" required>{{ old('message') }}</textarea>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit" name="button">Envoyer</button>
                </form>
            </div>
        </div>
    </div>

@endsection


