@extends('template.admin')

@section('content')
<style>
    body {
        background-color: #ffffff; /* Fondo blanco */
        font-family: 'Your Custom Font', sans-serif; /* Cambia 'Your Custom Font' por la fuente que desees */
    }

    .container {
        max-width: 600px;
        margin: 20px auto;
        border: 1px solid #ccc;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        background-color: #f5f5dc; /* Color de fondo beige */
    }

    .header {
        text-align: center;
        margin-bottom: 20px;
    }

    .header h1 {
        margin: 0;
        font-size: 28px; /* Tamaño de fuente más grande */
        color: #333;
    }

    .details {
        padding: 20px;
        border: 1px solid #ccc; /* Borde alrededor de detalles */
        border-radius: 5px;
        margin-bottom: 20px;
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
<div class="container">
    <div class="header">
        <!-- Agrega un logotipo o encabezado personalizado aquí si lo deseas -->
        <h1>Comprobante de Cuota</h1>
    </div>

    <div class="details">
        <div class="mb-3">
            <label class="form-label">ID de Cuota:</label>
            <div>{{ $cuota->Id_cuota }}</div>
        </div>
        <div class="mb-3">
            <label class="form-label">Nombre de Habitante:</label>
            <div>{{ $cuota->habitante->Nombre_habitante }} {{ $cuota->habitante->Apellido_habitante }}</div>
        </div>
        <div class="mb-3">
            <label class="form-label">Tipo de Cuota:</label>
            <div>{{ $cuota->tipoCuota->Descripcion }}</div>
        </div>
        <div class="mb-3">
            <label class="form-label">Fecha de Cuota:</label>
            <div>{{ $cuota->Fechacuota }}</div>
        </div>
        <div class="mb-3">
            <label class="form-label">Monto de Cuota:</label>
            <div>{{ $cuota->Monto_cuota }}</div>
        </div>
        <div class="mb-3">
            <label class="form-label">Año de Cuota:</label>
            <div>{{ $cuota->Año_cuota }}</div>
        </div>
    </div>

    <div class="footer">
        <a href="{{ route('cuotas.index') }}" class="btn btn-primary">Regresar al Listado</a>
        <button onclick="window.print()" class="btn btn-success">Imprimir Comprobante</button>
    </div>
</div>
@endsection
