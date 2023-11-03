@extends('template.admin')

@section('content')
<style>
    body {
        background-color: #f5f5dc;
    }

    .container {
        max-width: 600px;
        margin: auto;
        border: 1px solid #ccc;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        background-color: #f9f9f9;
    }

    .header {
        text-align: center;
        margin-bottom: 20px;
    }

    .header h1 {
        margin: 0;
        font-size: 24px;
        color: #333;
    }

    .details {
        background-color: #ffffff;
        padding: 20px;
        border-radius: 5px;
        margin-bottom: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .details .mb-3 {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
    }

    .details .form-label {
        font-weight: bold;
        color: #555;
        margin-right: 10px;
    }

    .footer {
        text-align: right;
    }

    .footer a,
    .footer button {
        margin-right: 10px;
    }
</style>

<div class="container mt-5">
    <h1>Registrar Nueva Cuota</h1>

    <form action="{{ route('cuotas.store') }}" method="POST">
        @csrf

        <!-- Campo para seleccionar el habitante con búsqueda habilitada -->
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
        


        <!-- Campo para seleccionar el tipo de cuota -->
        <div class="mb-3">
            <label for="Id_tipo_cuota" class="form-label">Tipo de Cuota</label>
            <select name="Id_tipo_cuota" id="Id_tipo_cuota" class="form-select" required>
                @foreach($tiposCuota as $tipoCuota)
                    <option value="{{ $tipoCuota->Id_tipo_cuota }}">{{ $tipoCuota->Descripcion }}</option>
                @endforeach
            </select>
        </div>

        <!-- Campo para ingresar la fecha de la cuota -->
        <div class="mb-3">
            <label for="Fechacuota" class="form-label">Fecha de Cuota</label>
            <input type="date" name="Fechacuota" id="Fechacuota" class="form-control" required>
        </div>

        <!-- Campo para ingresar el monto de la cuota -->
        <div class="mb-3">
            <label for="Monto_cuota" class="form-label">Monto de Cuota</label>
            <input type="number" step="0.01" name="Monto_cuota" id="Monto_cuota" class="form-control" required>
        </div>

        <!-- Campo para ingresar el año de la cuota -->
        <div class="mb-3">
            <label for="Año_cuota" class="form-label">Año de Cuota</label>
            <input type="number" min="2000" max="2100" name="Año_cuota" id="Año_cuota" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Registrar Cuota</button>
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
