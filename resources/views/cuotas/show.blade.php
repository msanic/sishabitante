@extends('template.admin')

@section('content')
<div class="container mt-5">
    
    <h1>Historial de Cuotas</h1>

    @if($historial->isEmpty())
        <p>No hay historial de cuotas disponible para este habitante.</p>
    @else
        <table class="table mt-4">
            <thead>
                <tr>
                    <th>ID Cuota</th>
                    <th>Tipo de Cuota</th>
                    <th>Fecha de Cuota</th>
                    <th>Monto</th>
                    <th>Año</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($historial as $cuota)
                    <tr>
                        <td>{{ $cuota->Id_cuota }}</td>
                        <td>{{ $cuota->tipoCuota->Descripcion ?? 'No especificado' }}</td>
                        <td>{{ $cuota->Fechacuota->format('d-m-Y') }}</td>
                        <td>{{ $cuota->Monto_cuota }}</td>
                        <td>{{ $cuota->Año_cuota }}</td>
                        <td>
                            <!-- Aquí puedes agregar botones para editar o eliminar cuotas -->
                            <a href="{{ route('cuotas.edit', $cuota->Id_cuota) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('cuotas.destroy', $cuota->Id_cuota) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

</div>
@endsection
