@extends('template.admin')

@section('content')
<div class="container mt-4" style="background-color: beige; padding: 20px; border-radius: 10px;">
    <h1 class="mb-4">Lista de Documentos</h1>

    <a href="{{ route('documentos.create') }}" class="btn btn-primary mb-3">Crear nuevo documento</a>

    <form action="{{ route('documentos.index') }}" method="GET" class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Buscar por nombre" aria-label="Buscar" name="search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
    </form>

    <table class="table table-bordered mt-3">
        <thead class="bg-primary text-white">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Fecha</th>
                <th>Descripción</th> <!-- Corregido el nombre del campo -->
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($documentos as $documento)
            <tr>
                <td>{{ $documento->Id_documento }}</td>
                <td>{{ $documento->Nombre_doc }}</td>
                <td>{{ \Carbon\Carbon::parse($documento->Fechadocumento)->format('d/m/Y') }}</td>
                <td>{{ $documento->Descripcion }}</td>
                <td>
                    <a href="{{ route('documentos.edit', $documento->Id_documento) }}" class="btn btn-success">Editar</a>
                    <a href="{{ route('documentos.show', $documento->Id_documento) }}" class="btn btn-info">Ver</a>
                    <form action="{{ route('documentos.destroy', $documento->Id_documento) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este documento?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                    <!-- Aquí puedes agregar botones para editar y eliminar -->
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
