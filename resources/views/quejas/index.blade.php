@extends('template.admin')

@section('content')
    <div class="container mt-5">
        <h1>Lista de Quejas</h1>
        <a href="{{ route('quejas.create') }}" class="btn btn-success mb-2">Crear Nueva Queja</a>
        
        <form action="{{ route('quejas.index') }}" method="GET">
    <label for="search_type">Tipo de búsqueda:</label>
    <select name="search_type">
        <option value="quejador">Por quejador</option>
        <option value="quejado">Por habitante quejado</option>
    </select>
    <input type="text" name="search" placeholder="Buscar...">
    <button type="submit">Buscar</button>
</form>

        <table class="table">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Quejador</th>
                    <th>habitante Quejado</th>
                    <th>Descripción</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($quejas as $queja)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($queja->Fecha_queja)->format('d/m/Y') }}</td>
                        <td>{{ $queja->habitante->Nombre_habitante }} {{ $queja->habitante->Apellido_habitante }}</td>
                        
                        <td>
                        @if ($queja->habitante_quejado)
                        {{ $queja->habitante_quejado->Nombre_habitante }} {{ $queja->habitante_quejado->Apellido_habitante }}
                        @else
                        N/A
                         @endif
                        </td>
                        <td>{{ $queja->Descripcion_queja }}</td>
                        <td>
                            <a href="{{ route('quejas.show', $queja->Id_queja) }}" class="btn btn-info">Ver</a>
                            <a href="{{ route('quejas.edit', $queja->Id_queja) }}" class="btn btn-primary">Editar</a>
                            <form action="{{ route('quejas.destroy', $queja->Id_queja) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta queja?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
