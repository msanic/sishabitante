@extends('template.admin')

@section('content')
<div class="container mt-5" style="background-color: beige; padding: 20px; border-radius: 10px;">
    <h1 class="mb-4">Editar Cuota</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('cuotas.update', $cuota->Id_cuota) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que quieres actualizar esta cuota?');">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="Id_habitante" class="form-label">ID Habitante</label>
            <select name="Id_habitante" id="Id_habitante" class="form-select">
                @foreach($habitantes as $habitante)
                    <option value="{{ $habitante->Id_habitante }}" {{ $habitante->Id_habitante == $cuota->Id_habitante ? 'selected' : '' }}>
                        {{ $habitante->Nombre_habitante }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="Id_tipo_cuota" class="form-label">Tipo de Cuota</label>
            <select name="Id_tipo_cuota" id="Id_tipo_cuota" class="form-select">
                @foreach ($tiposCuota as $tipo)
                    <option value="{{ $tipo->Id_tipo_cuota }}" {{ $tipo->Id_tipo_cuota == $cuota->Id_tipo_cuota ? 'selected' : '' }}>
                        {{ $tipo->Descripcion }}
                    </option>
                @endforeach
            </select>
        </div>
   
        <div class="mb-3">
            <label for="Fechacuota" class="form-label">Fecha de Cuota</label>
            <input type="date" name="Fechacuota" id="Fechacuota" class="form-control" value="{{ \Carbon\Carbon::parse($cuota->Fechacuota)->format('Y-m-d') }}">
        </div>

        <div class="mb-3">
            <label for="Monto_cuota" class="form-label">Monto de Cuota</label>
            <input type="number" name="Monto_cuota" id="Monto_cuota" class="form-control" value="{{ $cuota->Monto_cuota }}" min="0">
        </div>

        <div class="mb-3">
            <label for="Año_cuota" class="form-label">Año de Cuota</label>
            <input type="number" name="Año_cuota" id="Año_cuota" class="form-control" value="{{ $cuota->Año_cuota }}" min="2000" max="2099">
        </div>

        <div class="mb-3 text-center">
            <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </div>
    </form>
</div>
@endsection
