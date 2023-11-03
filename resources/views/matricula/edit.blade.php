@extends('template.admin')

@section('content')
<div class="container">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('matricula.update', $matricula->Id_matricula) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="Id_habitante">Habitante</label>
            <select name="Id_habitante" id="Id_habitante" class="form-control">
                @foreach($habitantes as $habitante)
                    <option value="{{ $habitante->Id_habitante }}" {{ ($habitante->Id_habitante == $matricula->Id_habitante) ? 'selected' : '' }}>{{ $habitante->Nombre_habitante }} {{ $habitante->Apellido_habitante }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="Monto_matricula">Monto de la Matrícula</label>
            <input type="text" name="Monto_matricula" id="Monto_matricula" class="form-control" value="{{ $matricula->Monto_matricula }}" required>
            @if ($errors->has('Monto_matricula'))
                <span class="text-danger">{{ $errors->first('Monto_matricula') }}</span>
            @endif
        </div>

        <div class="form-group">
            <label for="Fechamatricula">Fecha de Matrícula</label>
            <input type="date" name="Fechamatricula" id="Fechamatricula" class="form-control" value="{{ $matricula->Fechamatricula }}" required>
        </div>

        <div class="form-group">
            <label for="Descripcion_matri">Descripción</label>
            <textarea name="Descripcion_matri" id="Descripcion_matri" class="form-control" required>{{ $matricula->Descripcion_matri }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$(document).ready(function() {
    $('#Id_habitante').select2();
});
</script>
@endpush
