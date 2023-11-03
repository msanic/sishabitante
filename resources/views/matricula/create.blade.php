@extends('template.admin')

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <!-- Formulario de creación -->
    <form action="{{ route('matricula.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="Id_habitante" class="form-label">Habitante</label>
            <select name="Id_habitante" id="Id_habitante" class="form-control select2" style="width: 100%;">
                @foreach($habitantes as $habitante)
                    <option value="{{ $habitante->Id_habitante }}">
                        {{ $habitante->Nombre_habitante }} - {{ $habitante->Cui_habitante }} - {{ \Carbon\Carbon::parse($habitante->Fechanac_habitante)->format('d/m/Y') }}
                    </option>
                @endforeach
            </select>
        </div>
        



        <div class="form-group">
    <label for="Monto_matricula">Monto de la Matrícula</label>
    <input type="text" name="Monto_matricula" id="Monto_matricula" class="form-control" required>
    @if ($errors->has('Monto_matricula'))
        <span class="text-danger">{{ $errors->first('Monto_matricula') }}</span>
    @endif
</div>

        <div class="form-group">
            <label for="Fechamatricula">Fecha de Matrícula</label>
            <input type="date" name="Fechamatricula" id="Fechamatricula" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="Descripcion_matri">Descripción</label>
            <textarea name="Descripcion_matri" id="Descripcion_matri" class="form-control" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Inicializar Select2 -->
<script>
    $(document).ready(function() {
        $('#Id_habitante').select2({
            width: '100%', // Asegura que el campo de selección tenga el ancho completo
            language: {
                noResults: function() {
                    return "No se ha encontrado ningún resultado";
                }
            },
            escapeMarkup: function (markup) {
                return markup;
            }
        });
    });
</script>
@endsection