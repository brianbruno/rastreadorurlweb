@extends('layouts.app')

@section('content')
<table class="table">
    <thead>
    <tr>
        <th scope="col">Link</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($resultados as $resultado)
    <tr>
        <td>
            <a class="result" href="{{ route('find', ['id' => $resultado->ID]) }}">{{ $resultado->URL }}</a>
        </td>
    </tr>
    @endforeach
    </tbody>
</table>
@endsection
