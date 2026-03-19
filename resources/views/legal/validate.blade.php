@extends('layouts.app')

@section('content')
    <div class="site-content">
        <div class="container">
            <h3 class="content-title">Acceptez-vous les <a href="{{ route('legal.cgu') }}" target="_blank">CGU</a> de Curiositiz.com ?</h3>
            <hr class="content-divider">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <div class="content-subtitle">
                <a href="{{ route('legal.cgu') }}" target="_blank">Voir nos CGU en cliquant ici.</a>
            </div>

            <div class="row mt-5">
                <div class="col-12 col-md-6 text-center">
                    <a href="{{ route('accept_cgu') }}"><i class="fas fa-check"></i> Oui, j'accepte les CGU.</a>
                </div>
                <div class="col-12 col-md-6 text-center">
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fas fa-times"></i> Non, je n'accepte pas.</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
