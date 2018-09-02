@extends('layouts.app')

@section('content')
    @foreach ($resultados as $resultado)
        <p>{{ $resultado }}</p>
    @endforeach
@endsection
