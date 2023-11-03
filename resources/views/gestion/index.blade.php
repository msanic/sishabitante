@extends('template.admin')

@section('content')
<div class="container">
    <h1 class="mt-5">Lista de Documentos</h1>

    <a href="{{ route('documentos.create') }}" class="btn btn-primary mb-3">Crear nuevo documento</a>

    <table class="table table-bordered table-striped mt-3">
        <thead class="bg-beige">
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
                <td>{{ $documento->Fechadocumento }}</td>
                <td>{{ $documento->Descripcion }}</td>
                <td>
                    <a href="{{ route('documentos.show', $documento->Id_documento) }}" class="btn btn-info">Ver detalles</a>
                    <!-- Aquí puedes agregar botones para editar y eliminar -->
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
