@extends('admin.app')

@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('admin') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('admin.workshop.index') }}">Ateliers</a>
        </li>
        <li class="breadcrumb-item active">Modification</li>
    </ol>

    <div class="panel-body">
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        <hr />
        <h2>Modification de l'atelier "{{ $workshop->name }}"</h2>
         <form method="post" action="{{ route('admin.workshop.update', $slug) }}" class="form-section"
                    enctype="multipart/form-data">

                {{ csrf_field() }}
                {{ method_field('patch') }}

                <div class="form-row">
                    <div class="form-group col-md-6{{ $errors->has('title') ? ' has-error' : '' }}">
                        <label for="title" class="control-label">Nom de l’activité</label>
                        <input id="title" type="text" class="form-control" name="title" required placeholder="Nom de l’activité"
                                autofocus value="{{ $workshop->name }}">
                        @if ($errors->has('title'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                        @endif
                    </div>

                    <div class="form-group col-md-6 {{ $errors->has('address') ? ' has-error ' : '' }}">
                        <label for="address">Adresse</label>
                        <input id="address" type="text" class="form-control" autofocus
                                value="{{ $workshop->address }}" name="address">
                        @if($errors->has('address'))
                            <span class="help-block">
                                                    <strong>{{ $errors->first('address') }}</strong>
                                                </span>
                        @endif
                    </div>

                    <div class="form-group col-md-6" {{ $errors->has('city') ? ' has-error ' : '' }}>
                        <label for="city">Ville</label>
                        <input type="text" id="city" class="form-control" autofocus
                                value="{{ $workshop->city }}" name="city">
                        @if($errors->has('city'))
                            <span class="help-block">
                                                    <strong>{{ $errors->first('city') }}</strong>
                                                </span>
                        @endif
                    </div>

                    <div class="form-group col-md-6" {{ $errors->has('postal') ? ' has-error ' : '' }}>
                        <label for="postal">Département</label>
                        <select type="text" id="postal" autofocus value="{{ old('postal') }}"
                                class="form-control" name="postal">
                            <option value="{{ $workshop->postal }}">{{ $workshop->postal }}</option>
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
                        <label for="price">Prix</label>
                        <input id="price" type="number" class="form-control" name="price" required autofocus
                                placeholder="Prix" value="{{ $workshop->price }}" min="0">
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
                            <option value="{{ $workshop->org_type }}">{{ $workshop->getOrganizationType() }}</option>
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
                            <option value="{{ $workshop->age_mini }}">{{ $workshop->age_mini }}</option>
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
                            <option value="{{ $workshop->age_maxi }}">{{ $workshop->age_maxi }}</option>
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
                                value="{{ $workshop->effectif_max }}"
                                required autofocus min="1" max="12">

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
                                value="{{ $workshop->date->format('Y-m-d') }}"
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
                                value="{{ $workshop->begining }}" required autofocus>

                        @if ($errors->has('begining'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('begining') }}</strong>
                                    </span>
                        @endif
                    </div>

                    <div class="form-group col-md-6 {{ $errors->has('end') ? ' has-error' : '' }}">
                        <label for="end" class="control-label">Heure de fin</label>
                        <input id="end" type="time" class="form-control" name="end"
                                value="{{ $workshop->end }}"
                                required autofocus>

                        @if ($errors->has('end'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('end') }}</strong>
                                    </span>
                        @endif
                    </div>

                    <div class="form-group col-md-6 {{ $errors->has('picture') ? ' has-error' : '' }}">
                        <label for="picture" class="control-label">Illustration</label>
                        <div class="mb-2">
                            <img src="{{ asset('/images/workshops/'.$workshop->picture) }}" alt="" class="img-responsive img-thumbnail" height="200" width="200">
                        </div>
                        <input id="picture" type="file" class="form-control-file" name="picture"
                                autofocus>

                        @if ($errors->has('picture'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('picture') }}</strong>
                                    </span>
                        @endif
                    </div>


                    <div class="form-group col-md-6 {{ $errors->has('parent') ? ' has-error' : '' }}">
                        <label for="parent" class="control-label">Accompagnement de l’enfant durant l’activité </label>
                        <div class="" style="padding-top: 2px;padding-left: 20px">
                            <input class="form-check-input" type="checkbox" name="parent" id="parent" autofocus @if ($workshop->parent == 1) checked @endif>
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
                            <textarea class="form-control" rows="10" cols="auto"
                                    placeholder="Décrivez votre atelier"
                                    id="description" name="description"
                                    required>{{ $workshop->description }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="submit-form-button">
                    <button type="submit" class="btn btn-primary">Confirmer les modifications</button>
                </div>

            </form>
    </div>
@endsection
