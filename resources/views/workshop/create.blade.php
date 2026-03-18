@extends('layouts.app')

@section('content')

    <div class="site-content">
        <div class="container">
            <h3 class="content-title">Ateliers</h3>
            <hr class="content-divider">
            <div class="row">
                <div class="col-md-10 offset-1">
                    @if(session('message'))
                        <div class='alert alert-success'>
                            {{ session('message') }}
                        </div>
                    @endif
                    @if(session('workshop_delete'))
                        <div class='alert alert-success'>
                            {{ session('workshop_delete') }}
                        </div>
                    @endif
                </div>
                <div class="card offset-md-1 col-md-10">
                    <div class="card-body">
                        <h3 class="content-title">Créer un atelier</h3>
                        <hr class="content-divider">
                        <form method="post" action="{{ route('workshop.store') }}" class="form-section"
                              enctype="multipart/form-data">

                            {{ csrf_field() }}

                            <div class="form-row">
                                <div class="form-group col-md-6{{ $errors->has('title') ? ' has-error' : '' }}">
                                    <label for="title" class="control-label">Nom de l’activité</label>
                                    <input id="title" type="text" class="form-control" name="title" required
                                           placeholder="Nom de l’activité"
                                           autofocus value="{{ old('title') }}">
                                    @if ($errors->has('title'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('address') ? ' has-error ' : '' }}">
                                    <label for="address">Adresse de l’activité</label>
                                    <input id="address" type="text" class="form-control" autofocus
                                           value="{{ old('address') }}" name="address">
                                    @if($errors->has('address'))
                                        <span class="help-block">
                                                    <strong>{{ $errors->first('address') }}</strong>
                                                </span>
                                    @endif
                                </div>
                                <div class="form-group col-md-6" {{ $errors->has('city') ? ' has-error ' : '' }}>
                                    <label for="city">Ville</label>
                                    <input type="text" id="city" class="form-control" autofocus
                                           value="{{ old('city') }}" name="city">
                                    @if($errors->has('city'))
                                        <span class="help-block">
                                                    <strong>{{ $errors->first('city') }}</strong>
                                                </span>
                                    @endif
                                </div>
                                <div class="form-group col-md-6" {{ $errors->has('postal') ? ' has-error ' : '' }}>
                                    <label for="postal">Département</label>
                                    <select type="text" id="postal" autofocus
                                            class="form-control" name="postal" required>
                                        <option value="{{ old("postal") }}">{{ old("postal") }}</option>
                                        @foreach($departments as $code => $department)
                                            <option value="{{ $code }}">({{ $code }}) {{ $department }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('postal'))
                                        <span class="help-block">
                                                    <strong>{{ $errors->first('postal') }}</strong>
                                                </span>
                                    @endif
                                </div>

                                <div class="form-group col-md-6{{$errors->has('price') ? ' has-error' : ''}}">
                                    <label for="price">Prix par participant</label>
                                    <input id="price" type="number" class="form-control" name="price" required autofocus
                                           placeholder="Prix" value="{{ old('price') }}" min="0">
                                    @if ($errors->has('price'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('price') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('org_type') ? ' has-error' : '' }}">
                                    <label for="org_type" class="control-label">Vous êtes</label>

                                    <select id="org_type" type="time" class="form-control" name="org_type"
                                            required autofocus>
                                        <option value="{{ old("org_type") }}">{{ old("org_type") }}</option>
                                        <option value="1">{{ Config::get('constants.workshop_org_type.1') }}</option>
                                        <option value="2">{{ Config::get('constants.workshop_org_type.2') }}</option>
                                        <option value="3">{{ Config::get('constants.workshop_org_type.3') }}</option>
                                    </select>

                                    @if ($errors->has('org_type'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('org_type') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('age_mini') ? ' has-error' : '' }}">
                                    <label for="age_mini" class="control-label">Age minimum</label>
                                    <select id="age_mini" type="text" class="form-control" name="age_mini"
                                            required
                                            autofocus>
                                        <option value="{{ old("age_mini") }}">{{ old("age_mini") }}</option>
                                        <option value="1">1 an</option>
                                        <option value="2">2 ans</option>
                                        <option value="3">3 ans</option>
                                        <option value="4">4 ans</option>
                                        <option value="5">5 ans</option>
                                        <option value="6">6 ans</option>
                                        <option value="7">7 ans</option>
                                        <option value="8">8 ans</option>
                                        <option value="9">9 ans</option>
                                        <option value="10">10 ans</option>
                                        <option value="11">11 ans</option>
                                        <option value="12">12 ans</option>
                                        <option value="13">13 ans</option>
                                        <option value="14">14 ans</option>
                                        <option value="15">15 ans</option>
                                        <option value="18">18 ans</option>
                                    </select>

                                    @if ($errors->has('age_mini'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('age_mini') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('age_maxi') ? ' has-error' : '' }}">
                                    <label for="age_maxi" class="control-label">Age maximum</label>
                                    <select id="age_maxi" type="text" class="form-control" name="age_maxi"
                                            required
                                            autofocus>
                                        <option value="{{ old("age_maxi") }}">{{ old("age_maxi") }}</option>
                                        <option value="1">1 an</option>
                                        <option value="2">2 ans</option>
                                        <option value="3">3 ans</option>
                                        <option value="4">4 ans</option>
                                        <option value="5">5 ans</option>
                                        <option value="6">6 ans</option>
                                        <option value="7">7 ans</option>
                                        <option value="8">8 ans</option>
                                        <option value="9">9 ans</option>
                                        <option value="10">10 ans</option>
                                        <option value="11">11 ans</option>
                                        <option value="12">12 ans</option>
                                        <option value="13">13 ans</option>
                                        <option value="14">14 ans</option>
                                        <option value="15">15 ans</option>
                                        <option value="16">16 ans</option>
                                        <option value="17">17 ans</option>
                                        <option value="18">18 ans</option>
                                        <option value="99">99 ans</option>
                                    </select>

                                    @if ($errors->has('age_maxi'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('age_maxi') }}</strong>
                                    </span>
                                    @endif
                                </div>


                                <div class="form-group col-md-6 {{ $errors->has('effectif_max') ? ' has-error' : '' }}">
                                    <label for="effectif_max" class="control-label">Nombre maximum de
                                        participants</label>
                                    <input placeholder="Nombre de participants" id="effectif_max" type="number"
                                           class="form-control"
                                           name="effectif_max"
                                           value="{{ old('effectif_max') }}"
                                           required autofocus min="1" max="20">

                                    @if ($errors->has('effectif_max'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('effectif_max') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('date') ? ' has-error' : '' }}">
                                    <label for="date" class="control-label">Date</label>
                                    <input id="date" type="date" placeholder="MM/DD/YYY" class="form-control"
                                           name="date"
                                           value="{{ old('date') }}"
                                           required autofocus>

                                    @if ($errors->has('date'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('date') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('begining') ? ' has-error' : '' }}">
                                    <label for="begining" class="control-label">Heure de début</label>

                                    <input id="begining" type="time" class="form-control" name="begining"
                                           value="{{ old('begining') }}" required autofocus>

                                    @if ($errors->has('begining'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('begining') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('end') ? ' has-error' : '' }}">
                                    <label for="end" class="control-label">Heure de fin</label>
                                    <input id="end" type="time" class="form-control" name="end"
                                           value="{{ old('end') }}"
                                           required autofocus>

                                    @if ($errors->has('end'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('end') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('picture') ? ' has-error' : '' }}">
                                    <label for="picture" class="control-label">Illustration</label>
                                    <input id="picture" type="file" class="form-control-file" name="picture"
                                           value="{{ old('picture') }}"
                                           autofocus>
                                    <span class="help-block">10 Mo maximum</span>

                                    @if ($errors->has('picture'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('picture') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('parent') ? ' has-error' : '' }}">
                                    <label for="parent" class="control-label">Présence d'un adulte accompagnant l'enfant durant l’activité </label>
                                    <div class="" style="padding-top: 2px;padding-left: 20px">
                                        <input class="form-check-input" type="checkbox" name="parent" value="1" id="parent" autofocus>
                                        <p class="form-check-label" for="parent">
                                            Présence obligatoire d’un adulte
                                        </p>
                                        @if ($errors->has('parent'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('parent') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Description</label>
                                        <textarea class="form-control" rows="6" cols="auto" maxlength="500"
                                                  placeholder="Décrivez votre atelier"
                                                  id="description" name="description"
                                                  required>{{ old('description') }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="submit-form-button">
                                <button type="submit" class="btn btn-primary">Publier</button>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
