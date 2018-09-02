@extends('layouts.app')

@section('content')
<form method="POST" action="{{ route('buscar') }}">
    {{ csrf_field() }}
    <div class="form-group">
        <input type="text" class="form-control" id="inputURL" name="inputURL" placeholder="Digite a URL">
    </div>
    <button type="submit" class="btn btn-primary">Buscar</button>
</form>
@endsection
