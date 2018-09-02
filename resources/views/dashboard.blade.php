@extends('layouts.app')

@section('content')
    <form method="POST" action="{{ route('buscar') }}" autocomplete="off">
        {{ csrf_field() }}
        <div class="form-group">
            <input type="text" autocomplete="off" class="form-control" id="inputURL" name="inputURL" placeholder="Digite a URL" required>
        </div>
        <button type="submit" class="btn btn-lg btn-paradisepink">Buscar</button>
    </form>
    <hr><hr>
    <div class="footer">
        Sites visitados: {{ $visitas }}
    </div>
@endsection
