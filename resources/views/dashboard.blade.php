@extends('layouts.app')

@section('content')
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="title m-b-md">
                <a href="/">Rastreador</a>
            </div>
            <div>
                <form method="POST" action="{{ route('buscar') }}" autocomplete="off">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <input type="text" autocomplete="off" class="form-control" id="inputURL" name="inputURL" placeholder="Digite a URL" required>
                    </div>
                    <button type="submit" class="btn btn-lg btn-paradisepink">Buscar</button>
                </form>
                @if (!$resultados)
                    <hr>
                    <p>Ainda não procuramos por esse link. Tente novamente mais tarde.</p>
                @endif
                <hr><hr>
                <div class="footer">
                    Sites visitados: {{ $visitas }}
                </div>
            </div>

        </div>
    </div>

@endsection
