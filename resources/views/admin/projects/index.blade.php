@extends('layouts.app')

@section('content')

<div class="container my-3">

    <h2>I miei progetti</h2>

    @if (session('delete'))
        <div class="alert alert-success">
            {{session('delete')}}
        </div>
    @endif

        <table class="table">
        <thead>
            <tr>
                <th scope="col">#id</th>
                <th scope="col">Immagine</th>
                <th scope="col">Titolo</th>
                <th scope="col">Tipologia</th>
                <th scope="col">Tecnologia</th>
                <th scope="col">Azioni</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($projects as $project)
                <tr>
                    <td>{{$project->id}}</td>
                    <td>
                        <img class="thumb" src="{{asset('storage/' . $project->image)}}" alt="{{$project->original_name_img}}">
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

</div>

@endsection
