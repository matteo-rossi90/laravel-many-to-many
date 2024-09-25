
@extends('layouts.app')

@section('content')
<div class="p-3">
    <h3>Benvenuto {{ Auth::user()->name }}!</h1>
    <h4>Attualmente sono presenti {{$count_projects}} progetti nel tuo portfolio</h4>
</div>

@endsection
