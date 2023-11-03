@extends('template.admin')

@section('content')
<div class="container">
    <h1>Detalles de la Matrícula ID: {{ $matricula->Id_matricula }}</h1>
    
    <div class="mb-3">
        <label for="Nombre_habitante" class="form-label"><strong>Nombre del Habitante</strong></label>
        <input type="text" class="form-control" id="Nombre_habitante" value="{{ $matricula->habitante->Nombre_habitante }} {{ $matricula->habitante->Apellido_habitante }}" readonly>
    </div>

    <div class="mb-3">
        <label for="Monto_matricula" class="form-label"><strong>Monto de la Matrícula</strong></label>
        <input type="text" class="form-control" id="Monto_matricula" value="{{ $matricula->Monto_matricula }}" readonly>
    </div>

    <div class="mb-3">
        <label for="Fechamatricula" class="form-label"><strong>Fecha de Matrícula</strong></label>
        <input type="text" class="form-control" id="Fechamatricula" value="{{ $matricula->Fechamatricula }}" readonly>
    </div>

    <div class="mb-3">
        <label for="Descripcion_matri" class="form-label"><strong>Descripción</strong></label>
        <textarea class="form-control" id="Descripcion_matri" rows="3" readonly>{{ $matricula->Descripcion_matri }}</textarea>
    </div>

    <a href="{{ route('matricula.edit', $matricula->Id_matricula) }}" class="btn btn-warning">Editar</a>
    <a href="{{ route('matricula.index') }}" class="btn btn-secondary">Volver a la lista</a>
</div>
@endsection
