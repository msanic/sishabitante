@extends('template.admin')

@section('content')
<div class="container mt-5">
    <h1>Listado de Matrículas</h1>

    <div class="d-flex justify-content-between mb-3">
        <a href="{{ route('matricula.create') }}" class="btn btn-primary">Crear Nueva Matrícula</a>
        
        <form action="{{ route('matricula.export') }}" method="post">
            @csrf
            <label for="">Seleccionar año</label>
            <select name="año">
                @foreach($años as $año)
                    <option value="{{ $año }}">{{ $año }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-success">Excel</button>
        </form>

    
        
        <form action="{{ route('matricula.historial') }}" method="GET">
            <div class="input-group">
                <input type="text" name="habitante" class="form-control" placeholder="Buscar habitante por nombre">
                <button type="submit" class="btn btn-primary">Buscar</button>
            </div>
        </form>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre Habitante</th>
                <th scope="col">Monto Matrícula</th>
                <th scope="col">Fecha Matrícula</th>
                <th scope="col">Descripción</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($matriculas as $matricula)
                <tr>
                    
                    <td>{{ $matricula->Id_matricula }}</td>
                    <td>{{ $matricula->Nombre_habitante }} {{ $matricula->Apellido_habitante }}</td>
                    <td>{{ $matricula->Monto_matricula }}</td>
                    <td>{{ \Carbon\Carbon::parse($matricula->Fechamatricula)->format('d/m/Y') }}</td>
                    <td>{{ $matricula->Descripcion_matri }}</td>
                    <td>
                        <a href="{{ route('matricula.edit', $matricula->Id_matricula) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('matricula.destroy', $matricula->Id_matricula) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">No se encontraron resultados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
