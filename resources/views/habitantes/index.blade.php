@extends('template.admin')

@section('content')
<style>
    .beige-bg {
        background-color: #f5f5dc; /* Color beige de fondo */
        color: #333; /* Color de texto legible */
    }
</style>

<div class="container mt-5 beige-bg">
    <h1>Módulo Habitantes</h1>
    
    <a href="{{ route('habitantes.create') }}" class="btn btn-success mb-4">Agregar Nuevo</a>
    <a href="{{ route('habitantes.export') }}">Descargar reporte en Excel</a>
    <a href="{{ route('informe.habitantes') }}"class= "btn btn-success mb-4">Informe de Habitantes</a></li>

    <table id="example2" class="table table-striped">
        <thead>
            <tr>
            
                <th>Nombre</th>
                <th>Apellido</th>
                <th>CUI</th>
                <th>Género</th>
                <th>Fecha de Nacimiento</th>
                <th>Paraje</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($habitantes as $habitante)
                <tr>
                   
                    <td>{{ $habitante->Nombre_habitante }}</td>
                    <td>{{ $habitante->Apellido_habitante }}</td>
                    <td>{{ $habitante->Cui_habitante }}</td>
                    <td>{{ $habitante->Genero_habitante }}</td>
                    <td>{{ \Carbon\Carbon::parse($habitante->Fechanac_habitante)->format('d/m/Y') }}</td>
                    <td>{{ $habitante->Paraje }}</td>
                    <td>
                        <a href="{{ route('habitantes.edit', $habitante->Id_habitante) }}" class="btn btn-primary btn-sm">Editar</a>

                        <form action="{{ route('habitantes.destroy', $habitante->Id_habitante) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este habitante?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
