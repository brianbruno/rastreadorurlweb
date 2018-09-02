@extends('layouts.app')

@section('content')
    <div class="flex-center">
        <div class="content">
            <div class="title m-b-md">
                <a href="/">Rastreador</a>
            </div>
            <div>
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">Links</th>
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
            </div>

        </div>
    </div>
@endsection
