@extends('template.admin')

@section('content')
<div class="container">
    <h1>Detalles del Bien</h1>

    <p><strong>ID:</strong> {{ $bien->Id_bien }}</p>
    <p><strong>Nombre del bien:</strong> {{ $bien->Nombre_bien }}</p>
    <p><strong>Descripción:</strong> {{ $bien->Descripcion_bien }}</p>
    <p><strong>Fecha de ingreso:</strong> {{ $bien->Fecha_ingreso }}</p>
    <p><strong>Valor:</strong> {{ $bien->Valor_bien }}</p>

    <a href="{{ route('bienes.index') }}" class="btn btn-primary">Volver a la lista</a>
</div>
@endsection
