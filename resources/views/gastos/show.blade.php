@extends('template.admin')

@section('content')
<div class="container">
    <h1>Detalles del Gasto</h1>
    <p>ID: {{ $gasto->Id_gastos }}</p>
    <p>Fecha: {{ $gasto->Fecha_gastos }}</p>
    <p>Descripción: {{ $gasto->Descripcion_gastos }}</p>
    <p>Monto: Q{{ $gasto->Monto_gastos }}</p>
</div>
@endsection
Con estos cambios, deberías tener una página de detalles funcional para tus gastos. Adjusta los nombres de los campos y la estructura de la vista según tus necesidades.





