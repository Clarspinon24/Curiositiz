@extends('layouts.app')

@section('content')

    <div class="site-content">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-5 home-infos" style="text-align: center">
                    <div class="row">
                        <div class="col-md-12 mt-md-3">
                            <h2 id="big-title">Bienvenue sur {{ config("app.name") }} <br>
                                le spécialiste des activités ludiques pour enfants</h2>
                        </div>
                    </div>
                    <div class="row justify-content-center mt-3">
                        <div class="col-md-4 col-md-offset-1 col-6">
                            <img src="{{ asset("/images/Icon_index_2.png") }}" alt="" class="img-fluid img-responsive img-home">
                            <a href="#list">
                                <div class="blue-box mt-2">
                                    <p class="header-home-text">Nos activités ludiques</p>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4 col-md-offset-1 col-6">
                            <img src="{{ asset("/images/Icon_index_4.png") }}" alt="" class="img-fluid img-responsive img-home">
                            <a href="{{ route("sheet.index") }}">
                                <div class="blue-box mt-2">
                                    <p class="header-home-text">Nos bons plans gratuits</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card col-md-12">
                    <div class="card-body card-body pl-1 pl-md-3 pr-1 pr-md-3" id="list">

                        <div class="mb-4">
                            <form method="get" action="{{ route('workshop.index') }}" class="form-inline">
                                <label for="department">Filtrer par département</label>
                                <select type="text" id="department" autofocus style="height:auto;font-size: 11px !important;" class="form-control form-control-sm ml-0 ml-md-3" name="department">
                                    @if(Request::get('department'))
                                        <option value="{{ Request::get('department') }}">({{ Request::get('department') }}) {{ config('constants.departments')[Request::get('department')] }}</option>
                                    @endif
                                    <option value="">Tous les départements</option>
                                    @foreach($departments as $code => $department)
                                        <option value="{{ $code }}">({{ $code }}) {{ $department }}</option>
                                    @endforeach
                                </select>

                                <button type="submit" class="btn btn-primary mb-2 mt-3 mt-md-0 ml-0 ml-md-3">Filtrer</button>
                            </form>
                        </div>

                        <div class="row justify-content-center">
                            @foreach($workshops as $workshop)

                                @if(strtotime($workshop->date) > strtotime(date('Y/m/d')))

                                    <div class="col-md-12 card-workshop mb-1 mb-md-3">
                                        <a href="{{ route("workshop.show", ["slug" => $workshop->slug]) }}">
                                            <div class="row pl-1 pr-1">
                                                @if($workshop->picture)
                                                    <div class="col"
                                                            style="background-image: url('{{asset('/images/workshops/'.$workshop->picture)}}'); background-repeat: no-repeat; background-position: center; background-size: contain;">

                                                    </div>
                                                @else
                                                    <div class="col" style="background-color: gray"></div>
                                                @endif
                                                {{------------------------------------------ DESKTOP --------------------------------------------------------------------------}}
                                                <div class="col-9 pt-1 pb-1 d-none d-md-block">
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="card-workshop-title">
                                                                {{ $workshop->name }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row pt-3">
                                                        <div class="col-4">
                                                            {{--TRANCHE D'AGE DE L'ATELIER--}}
                                                            @if($workshop->age_mini == 1)
                                                                <div>{{ $workshop->age_mini }} an
                                                                    - {{ $workshop->age_maxi }} ans
                                                                </div>
                                                            @else
                                                                <div>{{ $workshop->age_mini }} ans
                                                                    - {{ $workshop->age_maxi }} ans
                                                                </div>
                                                            @endif

                                                            {{--PLACE RESTANTES DANS L'ATELIER--}}
                                                            @if($workshop->effectif_max > 0)
                                                                <div>{{ $workshop->effectif_max}} places restantes
                                                                </div>
                                                            @else
                                                                <div> Complet</div>
                                                            @endif

                                                            {{-- inscrit
                                                            <div>{{ $workshop->maximum - $workshop->effectif_max }}
                                                                personnes inscrites
                                                            </div>
                                                            --}}


                                                        </div>
                                                        <div class="col-4">
                                                            <div>{{ $workshop->begining}} - {{ $workshop->end }}</div>
                                                            <div> {{ $workshop->date->format('d/m/Y') }} </div>
                                                            <div>{{ $workshop->price }}
                                                                €/personne
                                                            </div>
                                                            <div>{{ $workshop->city }}
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="d-flex align-items-center" style="height: 100%;">
                                                                <div>
                                                                    <img src="{{ $workshop->user->avatar() }}" alt="" class="img-responsive" height="60" width="60">
                                                                </div>
                                                                <div class="ml-2">
                                                                    {{ $workshop->user->firstname }} <br>
                                                                    @if($workshop->user->getRating() === -1)

                                                                    @else
                                                                        {{ $workshop->user->getRating() }}/5 <i class="fa fa-fw fa-star"></i>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row pt-3">
                                                        <div class="col-12">
                                                            {{ str_limit($workshop->description, $limit = 50, $end = '...') }}
                                                        </div>
                                                    </div>
                                                </div>
                                                {{------------------------------------------MOBILE------------------------------------------------}}
                                                <div class="col-8 pt-1 pb-1 d-sm-block d-md-none">
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="card-workshop-title">
                                                                {{ $workshop->name }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-8">
                                                            {{--TRANCHE D'AGE DE L'ATELIER--}}
                                                            @if($workshop->age_mini == 1)
                                                                <div>{{ $workshop->age_mini }} an
                                                                    - {{ $workshop->age_maxi }} ans
                                                                </div>
                                                            @else
                                                                <div>{{ $workshop->age_mini }} ans
                                                                    - {{ $workshop->age_maxi }} ans
                                                                </div>
                                                            @endif

                                                            <div>{{ $workshop->begining}} - {{ $workshop->end }}</div>
                                                            <div>{{ $workshop->date->format('d/m/Y') }}</div>
                                                            <div>{{ $workshop->city }}
                                                                {{--PLACE RESTANTES DANS L'ATELIER--}}
                                                                @if($workshop->effectif_max > 0)
                                                                    <div>{{ $workshop->effectif_max}} places restantes
                                                                    </div>
                                                                @else
                                                                    <div> Complet</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-4 pl-0">
                                                            <div class="d-flex align-items-center" style="height: 100%;">
                                                                <div class="text-center">
                                                                    <img src="{{ $workshop->user->avatar() }}" alt="" class="img-responsive" height="20" width="20">

                                                                    <div class="mt-2">
                                                                        {{ $workshop->user->firstname }} <br>
                                                                        @if($workshop->user->getRating() === -1)

                                                                        @else
                                                                            {{ $workshop->user->getRating() }}/5 <i class="fa fa-fw fa-star"></i>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection
