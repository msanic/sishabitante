@extends('template.admin')

@section('content')
<style>
    body {
        background-color: #f5f5dc; /* Color beige de fondo */
    }
</style>
<div class="container mt-4">
    <h1 class="mb-4">Lista de Bienes</h1>
    
    <a href="{{ route('bienes.create') }}" class="btn btn-success mb-4">Registrar Nuevo</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre del Bien</th>
                <th>Descripción</th>
                <th>Fecha de Ingreso</th>
                <th>Valor</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bienes as $bien)
            <tr>
                <td>{{ $bien->Id_bien }}</td>
                <td>{{ $bien->Nombre_bien }}</td>
                <td>{{ $bien->Descripcion_bien }}</td>
                <td>{{ $bien->Fecha_ingreso }}</td>
                <td>{{ $bien->Valor_bien }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <a href="{{ route('bienes.show', $bien->Id_bien) }}" class="btn btn-info btn-sm">Detalles</a>
                        <a href="{{ route('bienes.edit', $bien->Id_bien) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('bienes.destroy', $bien->Id_bien) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este bien?');" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

