@extends('layouts.app')

@section('content')

<div class="container my-3">

    <div class="d-flex justify-content-between align-items-center mb-5">
        <h2 class="my-3">I miei progetti</h2>
        <form action="{{route('admin.projects.index')}}" class="d-flex" onsubmit="return validateSearch()">
            <div class="btn-group">
                <input type="search" name="search" class="form-control" id="validate">
                <button type="submit" class="btn btn-outline-primary">
                    Cerca
                </button>
                <a href="{{route('admin.projects.index')}}" class="btn btn-outline-danger">
                    Annulla
                </a>
            </div>
        </form>
    </div>

    @if (session('delete'))
        <div class="alert alert-success">
            {{session('delete')}}
        </div>
    @endif

    @if($projects->count() > 0)
    <table class="table">
        <thead>
            <tr>
                <th scope="col">
                    <a href="{{route('admin.projects.index', ['direction' => $direction, 'column' => 'id'])}}">
                         #id
                    </a>
                </th>
                <th scope="col">Immagine</th>
                <th scope="col">
                    <a href="{{route('admin.projects.index', ['direction' => $direction, 'column' => 'title'])}}">
                        Titolo
                    </a>
                </th>
                <th scope="col">
                    <a href="{{route('admin.projects.index', ['direction' => $direction, 'column' => 'type_id'])}}">
                        Tipologia
                    </a>
                </th>
                <th scope="col">
                    Tecnologia
                </th>
                <th scope="col">Azioni</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($projects as $project)
                <tr>
                    <td>{{$project->id}}</td>
                    <td>
                        <img class="img-thumb" src="{{asset('storage/' . $project->img)}}" alt="{{$project->original_name_img}}"
                        onerror="this.src='/img/placeholder.jpg'">
                    </td>
                    <td>{{$project->title}}</td>
                    <td>
                        <span class="badge text-bg-info">
                            {{$project->type?->name}}
                        </span>
                    </td>
                    <td>
                        @forelse ($project->technologies as $technology )
                            <span class="badge text-bg-success">
                                {{ $technology->name }}
                            </span>
                        @empty
                            -
                        @endforelse

                    </td>
                    <td>
                        <a href="{{route('admin.projects.show', $project)}}" class="btn btn-primary">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                        <a href="{{route('admin.projects.edit', $project)}}" class="btn btn-warning">
                            <i class="fa-solid fa-pencil"></i>
                        </a>

                        <form  class="d-inline" onsubmit="return confirm('Vuoi proprio eliminare il progetto {{$project->title}} ?')" action="{{route('admin.projects.destroy', $project)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{$projects->links()}}
    </div>
    @else
        <p>La ricerca non ha prodotto alcun risultato</p>
    @endif
</div>

@endsection
