@extends('template.admin')

@section('content')
<div class="container mt-5" style="background-color: beige; padding: 20px; border-radius: 10px;">
    <h1 class="mb-4">Historial</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('cuotas.historial') }}" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="habitante" class="form-control" placeholder="Buscar habitante por nombre" value="{{ request('habitante') }}">
            <button type="submit" class="btn btn-primary">Buscar</button>
        </div>
    </form>

    @if(count($cuotas) > 0)
        <table class="table table-bordered">
            <thead class="bg-primary text-white">
                <tr>
                  
                    <th>Habitante</th>
                    <th>Tipo de Cuota</th>
                    <th>Fecha de Cuota</th>
                    <th>Monto de Cuota</th>
                    <th>Año de Cuota</th>
                    <th>Acciones</th>
                    <th>Comprobante</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cuotas as $cuota)
                    <tr>
                       
                        <td>{{ $cuota->habitante->Nombre_habitante }} {{ $cuota->habitante->Apellido_habitante }}</td>
                        <td>{{ $cuota->tipoCuota->Descripcion }}</td>
                        <td>{{ $cuota->Fechacuota }}</td>
                        <td>{{ $cuota->Monto_cuota }}</td>
                        <td>{{ $cuota->Año_cuota }}</td>
                        <td>
                            <a href="{{ route('cuotas.edit', $cuota->Id_cuota) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('cuotas.destroy', $cuota->Id_cuota) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar esta cuota?');">Eliminar</button>
                            </form>
                        </td>
                        <td>
                            <a href="{{ route('cuotas.comprobante', ['id' => $cuota->Id_cuota]) }}" class="btn btn-primary">Ver Comprobante</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No se encontraron resultados para la búsqueda.</p>
    @endif
</div>
@endsection
