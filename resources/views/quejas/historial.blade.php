@extends('template.admin')

@section('content')
<div class="container mt-5">
    <h1>Historial de Quejas</h1>

    <form action="{{ route('quejas.historial') }}" method="GET" class="form-inline mb-3">
        <input type="text" name="search" class="form-control" placeholder="Buscar por nombre o apellido" value="{{ request()->get('search') }}">
        <button type="submit" class="btn btn-primary ml-2">Buscar</button>
    </form>
    {{ dd($quejas) }}
    {{ var_dump($searchPerformed) }}
{{ var_dump($quejas) }}

    @if($searchPerformed)
        @if($quejas->isEmpty())
            <div class="alert alert-warning">
                No se encontraron quejas para el criterio de búsqueda proporcionado.
            </div>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Fecha</th>
                        <th>Descripción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($quejas as $queja)
                        <tr>
                            <td>{{ $queja->Id_queja }}</td>
                            <td>{{ $queja->Fecha_queja }}</td>
                            <td>{{ $queja->Descripcion_queja }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    @endif
</div>
@endsection
