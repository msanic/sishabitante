@extends('template.admin')

@section('content')
<div class="container mt-5">
    <h1>Detalles del Habitante</h1>

    <p>ID: {{ $habitante->Id_habitante }}</p>
    <p>Nombre: {{ $habitante->Nombre_habitante }}</p>
    <p>Apellido: {{ $habitante->Apellido_habitante }}</p>
    <p>CUI: {{ $habitante->Cui_habitante }}</p>
    <p>Género: {{ $habitante->Genero_habitante }}</p>
    <p>Fecha de nacimiento: {{ \Carbon\Carbon::parse($habitante->Fechanac_habitante)->format('d/m/Y') }}</p>
    <p>Paraje: {{ $habitante->Paraje }}</p>

    <!-- Botones para editar y volver a la lista -->
    <a href="{{ route('habitantes.edit', $habitante->Id_habitante) }}" class="btn btn-warning">Editar</a>
    <a href="{{ route('habitantes.index') }}" class="btn btn-secondary">Volver a la lista</a>


</div>
@endsection
