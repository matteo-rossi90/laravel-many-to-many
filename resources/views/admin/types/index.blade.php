@extends('layouts.app')

@section('content')

<div class="container">

    <h2 class="my-4">Tipi di progetto</h2>

    @if($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>
                    <div class="alert alert-danger">
                        {{$error}}
                    </div>
                </li>
            @endforeach
        </ul>
    @endif

    @if (session('error'))
        <div class="alert alert-warning">
            {{session('error')}}
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{session('success')}}
        </div>
    @endif

    @if (session('deleted'))
        <div class="alert alert-success">
            {{session('deleted')}}
        </div>
    @endif

    @if (session('edited'))
        <div class="alert alert-success">
            {{session('edited')}}
        </div>
    @endif

    <div class="row">
        <div class="col-md-6">

            <form action="{{route('admin.types.store')}}" class="d-flex justify-content-between gap-2 mb-4" method="POST">
                @csrf
                <input type="text" name="name" class="form-control" placeholder="Inserisci una nuova tipologia">
                <button type="submit" class="btn btn-info">Invia</button>
            </form>

            <table class="table my-5">
                <tbody>
                    @foreach ($types as $type)
                        <tr>
                            <td class="w-75">
                                <form id="form-edit-{{ $type->id }}" action="{{route('admin.types.update', $type)}}" method="POST" class="d-flex justify-content-between gap-2">
                                    @csrf
                                    @method('PUT')

                                    <input class="border-input" type="text" name="name" value="{{$type->name}}">

                                </form>
                            </td>
                            <td>
                                <button type="submit" class="btn btn-warning" onclick="submitFormById({{$type->id}})">Aggiorna</button>
                            </td>
                            <td class="text-end">
                                <form action="{{route('admin.types.destroy', $type)}}" method="POST" onsubmit="return confirm('Vuoi davvero eliminare questa tipologia?');">

                                    @include('admin.partials.formdelete')

                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
