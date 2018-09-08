@extends('layouts.app')

@section('content')
    <div class="flex-center">
        <div class="content">
            <div class="title m-b-md">
                <a href="/">Rastreador</a>
            </div>
            <div>
                <rastreador :idurl="{{ $id }}"></rastreador>
                {{--@foreach ($resultados as $resultado)
                    @foreach($resultado as $sites)
                        <p class="result">{{ $sites }}</p>
                    @endforeach
                @endforeach--}}
                {{--<arvore></arvore>--}}
            </div>

        </div>
    </div>


@endsection
