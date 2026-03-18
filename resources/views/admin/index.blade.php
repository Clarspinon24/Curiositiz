@extends('admin.app')

@section('content')

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Accueil</li>
    </ol>
    <!-- Icon Cards-->
    @if(session('message'))
        <div class='alert alert-success'>
            {{ session('message') }}
        </div>
    @endif
    <div class="row">
        <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-primary o-hidden h-100">
                <div class="card-body">
                    <div class="card-body-icon">
                        <i class="fa fa-fw fa-users"></i>
                    </div>
                    <div class="mr-5">{{ $users }} utilisateurs</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="{{ route('admin.user.index') }}">
                    <span class="float-left">Gérer</span>
                    <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
                </a>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-danger o-hidden h-100">
                <div class="card-body">
                    <div class="card-body-icon">
                        <i class="fa fa-fw fa-calendar"></i>
                    </div>
                    <div class="mr-5">{{ $workshops }} ateliers</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="{{ route('admin.workshop.index') }}">
                    <span class="float-left">Gérer</span>
                    <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
                </a>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-success o-hidden h-100">
                <div class="card-body">
                    <div class="card-body-icon">
                        <i class="fa fa-fw fa-th"></i>
                    </div>
                    <div class="mr-5">{{ $sheets }} bons plans</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="{{ route('admin.sheet.index') }}">
                    <span class="float-left">Gérer</span>
                    <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
                </a>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-warning o-hidden h-100">
                <div class="card-body">
                    <div class="card-body-icon">
                        <i class="fa fa-fw fa-newspaper-o"></i>
                    </div>
                    <div class="mr-5">{{ $articles }} articles de blog</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="{{ route('admin.blog.index') }}">
                    <span class="float-left">Gérer</span>
                    <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
                </a>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-info o-hidden h-100">
                <div class="card-body">
                    <div class="card-body-icon">
                        <i class="fa fa-fw fa-handshake-o"></i>
                    </div>
                    <div class="mr-5">Mise à jour des CGU</div>
                </div>
                <form class="card-footer text-white clearfix small z-1" href="{{ route('legal.store') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <span class="float-left">
                        <input type="file" name="file" id="file">
                    </span>
                    <span class="float-right">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-fw fa-check"></i></button>
                    </span>
                </form>
            </div>
        </div>
    </div>


@endsection




