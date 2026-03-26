@extends('layouts.app')
@use('Illuminate\Support\Str')

@section('content')
    <div class="site-content">
        <div class="container">
            <h3 class="content-title">Bons plans</h3>
            <hr class="content-divider">
            <div class="text-center">
                <p>Profitez gratuitement des bons plans Curiositiz en téléchargeant nos fiches <br>
                    Vous avez des bons plans ? Partagez-les ! <br>
                    Envoyez-les nous via "Nous contacter".
                </p>
            </div>

            <div class="row d-flex align-items-stretch">
                @if(count($sheets) > 0)
                    @foreach($sheets as $sheet)
                        {{-- Desktop --}}
                        <div class="col-md-4 d-none d-md-flex" style="margin-bottom: 20px;">
                            <div class="card text-center w-100">
                                <img class="card-img-top" src="{{ asset('images/sheets/'.$sheet->image) }}"
                                     alt="responsive-img" style="height: 220px; object-fit: cover;">
                                <div class="card-body d-flex flex-column">
                                    <div class="card-age mx-auto d-block">
                                        {{$sheet->ageRange()}}
                                    </div>
                                    <div class="card-title">{{$sheet->title}}</div>
                                    <small>{{$sheet->user->name}} | {{$sheet->created_at}}</small>
                                    <div class="card-text mt-2 flex-grow-1">
                                        {{ Str::limit($sheet->content, 100) }}
                                    </div>
                                    <div class="card-button-group mt-3">
                                        <a class="card-button-outline"
                                           href="{{ asset('pdf/sheets/').'/'.$sheet->file_name }}" target="_blank">Télécharger</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Mobile --}}
                        <div class="col-12 card-workshop d-md-none d-block">
                            <div class="row pl-1 pr-1 pt-2 pb-2">
                                @if($sheet->image)
                                    <div class="col" style="background-image: url('{{asset('/images/sheets/'.$sheet->image)}}'); background-repeat: no-repeat; background-position: center; background-size: contain;">
                                    </div>
                                @else
                                    <div class="col" style="background-color: gray"></div>
                                @endif
                                    <div class="col-7">
                                        <div class="row">
                                            <div class="col-12">
                                                {{ $sheet->title }}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                {{ $sheet->created_at }}
                                            </div>
                                        </div>
                                        <div class="row pt-2">
                                            <div class="col-12">
                                                <div>{{ Str::limit($sheet->content, 30) }}</div>
                                            </div>
                                        </div>
                                        <div class="row justify-content-center">
                                            <div class="col-12 card-button-group">
                                                <a class="card-button-outline"
                                                   href="{{ asset('pdf/sheets/').'/'.$sheet->file_name }}" target="_blank">Télécharger</a>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p>AUCUNE FICHE CONSEIL N'EST DISPONIBLE POUR LE MOMENT</p>
                @endif
            </div>
        </div>
    </div>
@endsection