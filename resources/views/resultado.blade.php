@extends('layouts.app')

@section('content')
    @foreach ($resultados as $resultado)
        <p class="result">{{ $resultado }}</p>
    @endforeach
@endsection
