@extends('template.admin')

@section('content')
    <div class="container mt-5">
        <h1>Crear Nueva Queja</h1>
        <form action="{{ route('quejas.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="fecha_queja">Fecha de la Queja:</label>
                <input type="date" name="fecha_queja" class="form-control" required>
            </div>
            <div class="mb-3">
            <label for="habitante_queja" class="form-label">Quejador</label>
            <select name="habitante_queja" id="Id_habitante" class="form-control select2" style="width: 100%">
                @foreach($habitantes as $habitante)
                    <option value="{{ $habitante->Id_habitante }}">
                        {{ $habitante->Nombre_habitante }} - {{ $habitante->Cui_habitante }} - {{ \Carbon\Carbon::parse($habitante->Fechanac_habitante)->format('d/m/Y') }}
                    </option>
                @endforeach
            </select>
        </div>



        <div class="mb-3">
            <label for="habitante_queja" class="form-label">Habitante</label>
            <select name="habitante_quejado" id="Id_habitante" class="form-control select2" style="width: 100%">
            <option value="">Seleccionar habitante (opcional)</option>  
                @foreach($habitantes as $habitante)
                    <option value="{{ $habitante->Id_habitante }}">
                        {{ $habitante->Nombre_habitante }} - {{ $habitante->Cui_habitante }} - {{ \Carbon\Carbon::parse($habitante->Fechanac_habitante)->format('d/m/Y') }}
                    </option>
                @endforeach
            </select>
        </div>


            <div class="form-group">
                <label for="descripcion_queja">Descripción de la Queja:</label>
                <textarea name="descripcion_queja" class="form-control" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Crear Queja</button>
        </form>

        <hr>

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
