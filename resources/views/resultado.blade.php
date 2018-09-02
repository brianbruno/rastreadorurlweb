@extends('layouts.app')

@section('content')
    <div class="flex-center">
        <div class="content">
            <div class="title m-b-md">
                <a href="/">Rastreador</a>
            </div>
            <div>
                @foreach ($resultados as $resultado)
                    <p class="result">{{ $resultado }}</p>
                @endforeach
            </div>

        </div>
    </div>


@endsection
