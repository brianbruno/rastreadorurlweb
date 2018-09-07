@extends('layouts.app')

@section('content')
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="title m-b-md">
                <a href="/">Rastreador</a>
            </div>
            <div>
                <h3>Inserir URL</h3>
                <form method="POST" action="{{ route('inserir-url') }}" autocomplete="off">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <input type="text" autocomplete="off" class="form-control" id="inputURL" name="inputURL" placeholder="Digite a URL" required>
                    </div>
                    <button type="submit" class="btn btn-lg btn-paradisepink">Inserir</button>
                </form>
                @if (!empty($resultado) && !$resultado)
                    <hr>
                    <p>Não foi possível salvar a url desejada.</p>
                @elseif (!empty($resultado) && $resultado)
                    <hr>
                    <p>A url foi salva com sucesso!</p>
                @endif
            </div>

        </div>
    </div>

@endsection
