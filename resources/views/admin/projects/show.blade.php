@extends('layouts.app')

@section('content')

<div class="container my-3">

    <h2>{{$project->title}}</h2>

    @if (session('edited'))
        <div class="alert alert-success">
            {{session('edited')}}
        </div>
    @endif
    <div class="row g-2">
        <div class="col-6">
            <ul class="list-group list-group-flush my-3">
                <li class="list-group-item d-inline">
                    <span><strong>Argomenti trattati: </strong></span><span>{{$project->theme}}</span>
                </li>
                <li class="list-group-item d-inline">
                    <span><strong>Azienda/responsabile: </strong></span><span>{{$project->company}}</span>
                </li>
                <li class="list-group-item d-inline">
                    <span><strong>Tecnologie: </strong></span>
                    @forelse ($project->technologies as $technology )
                        <span class="badge text-bg-warning">{{$technology->name}}</span>
                    @empty
                        <span>Nessuna tecnologia</span>
                    @endforelse
                </li>
                <li class="list-group-item d-inline">
                    <span><strong>Tipologia: </strong></span><span>{{$project->type ? $project->type->name : 'Nessuna'}}</span>
                </li>
                <li class="list-group-item d-inline">
                    <span><strong>Iniziato il: </strong></span><span>{{($project->start_date)->format('d/m/Y')}}</span>
                </li>
                <li class="list-group-item d-inline">
                    <span><strong>Terminato il: </strong></span><span>{{($project->end_date)->format('d/m/Y')}}</span>
                </li>
                <li class="list-group-item">
                    <h6><strong>Descrizione</strong></h6><span>{{$project->description}}</span>
                </li>

            </ul>

        </div>
        <div class="col-6">
            <img class="img-fluid" src="{{asset('storage/' . $project->img)}}" alt="{{$project->original_name_img}}">
        </div>

    </div>

    <a href="{{route('admin.projects.index')}}" class="btn btn-primary">Indietro</a>

</div>

@endsection
