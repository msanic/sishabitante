@extends('template.admin')

@section('content')
    <div class="container mt-5">
        <h1>Detalles de la Queja</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Fecha: {{ $queja->Fecha_queja }}</h5>
                <h6 class="card-subtitle mb-2 text-muted">Quejador: {{ $queja->habitante->Nombre_habitante }} {{ $queja->habitante->Apellido_habitante }}</h6>
                <h6 class="card-subtitle mb-2 text-muted">habitante quejado:
@if ($queja->habitante_quejado)
    {{ $queja->habitante_quejado->Nombre_habitante }} {{ $queja->habitante_quejado->Apellido_habitante }}
@else
    No asignado
@endif
</h6>




                <p class="card-text">Descripción: {{ $queja->Descripcion_queja }}</p>
            </div>
        </div>
        <form id="eliminar-form" action="{{ route('quejas.destroy', $queja->Id_queja) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="button" onclick="confirmarEliminacion()" class="btn btn-danger mt-3">Eliminar</button>
        </form>
        <a href="{{ route('quejas.index') }}" class="btn btn-primary mt-3">Volver</a>
    </div>
    <script>
        function confirmarEliminacion() {
            if (confirm('¿Estás seguro de que deseas eliminar esta queja?')) {
                document.getElementById('eliminar-form').submit();
            }
        }
    </script>
@endsection