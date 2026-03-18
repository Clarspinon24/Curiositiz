@extends('admin.app')

@section('content')
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('admin') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Bons plans</li>
    </ol>


    <!-- Content -->
    <div class="panel-body">
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        <hr>

           <h2>Liste des bons plans <a href="{{ route('admin.sheet.create')}}" class="btn btn-success btn-sm"> <i class="fa fa-fw fa-plus"></i> Ajouter un bon plan</a></h2>
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-sm">
                    <tr>
                        <th>Titre</th>
                        <th>Actions</th>
                    </tr>
                    @if(count($sheets) > 0)
                        @foreach($sheets as $sheet)
                            <tr>
                                <td style="width:70%;">{{$sheet->title}}</td>
                                <td>
                                    <a class="btn btn-warning btn-sm d-inline-block" href="{{ route('admin.sheet.show', $sheet->id) }}">Afficher</a>
                                    <a class="btn btn-primary btn-sm d-inline-block ml-2" href="{{ route('admin.sheet.edit', $sheet->id)}}">Modifier</a>
                                    <form action="{{ route('admin.sheet.destroy', $sheet->id)}}" method="POST" class="d-inline-block ml-2">
                                        {{ csrf_field() }}
                                        {{ method_field('delete') }}
                                        <button class="btn btn-danger btn-sm">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </table>
            </div>

    </div>
@endsection

