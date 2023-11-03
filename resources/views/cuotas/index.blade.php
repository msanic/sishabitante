@extends('template.admin')

@section('content')
<div class="container mt-5" style="background-color: beige; padding: 20px; border-radius: 10px;">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Gestion de Pagos</h1>
        <a href="{{ route('cuotas.create') }}" class="btn btn-primary">Registrar Nueva Cuota</a>
     
        <form action="{{ route('cuotas.export') }}" method="post">
            @csrf
            <label for="">Seleccionar año</label>
            <select name="año">
                @foreach($años as $año)
                    <option value="{{ $año }}">{{ $año }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-success">Excel</button>
        </form>
       
    </div>

    <div class="mb-3">
        <form action="{{ route('cuotas.historial') }}" method="GET">
            <div class="input-group">
                <input type="text" name="habitante" class="form-control" placeholder="Buscar habitante por nombre">
                <button type="submit" class="btn btn-primary">Buscar</button>
            </div>
        </form>
    </div>

    <table class="table table-bordered">
        <thead class="bg-primary text-white">
            <tr>
                <th>ID</th>
                <th>Habitante</th>
                <th>Tipo de Cuota</th>
                <th>Fecha</th>
                <th>Monto</th>
                <th>Año</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cuotas as $cuota)
                <tr>
                    <td>{{ $cuota->Id_cuota }}</td>
                    <td>{{ $cuota->habitante->Nombre_habitante }} {{ $cuota->habitante->Apellido_habitante }}</td>
                    <td>{{ $cuota->tipoCuota->Descripcion }}</td>
                    <td>{{ \Carbon\Carbon::parse($cuota->Fechacuota)->format('d/m/Y') }}</td>
                    
                    <td>Q.{{ $cuota->Monto_cuota }}</td>
                    <td>{{ $cuota->Año_cuota }}</td>
                    <td>
                        <a href="{{ route('cuotas.edit', $cuota->Id_cuota) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('cuotas.destroy', $cuota->Id_cuota) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar esta cuota?');">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
