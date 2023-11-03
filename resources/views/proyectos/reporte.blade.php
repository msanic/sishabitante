@extends('template.admin')

@section('content')
<div class="container mt-5">
    <h1>Reporte de Proyectos por Comité</h1>

    @foreach($comites as $comite)
    <h2>{{ $comite->Nombre_comite }}</h2>

    @if($comite->proyectos->isNotEmpty())
        @foreach($comite->proyectos as $proyecto)
        <div>
            <strong>Nombre del Proyecto:</strong> {{ $proyecto->Nombre_proyecto }}<br>
            <strong>Descripción:</strong> {{ $proyecto->Descripcion_proyecto }}<br>
            <strong>Fecha de Autorización:</strong> {{ $proyecto->Fecha_autorizacion ? $proyecto->Fecha_autorizacion->format('d-m-Y') : 'No especificado' }}<br>
            <strong>Fecha de Inicio:</strong> {{ $proyecto->Fecha_inicio ? $proyecto->Fecha_inicio->format('d-m-Y') : 'No especificado' }}<br>
            <strong>Fecha de Fin:</strong> {{ $proyecto->Fecha_fin ? $proyecto->Fecha_fin->format('d-m-Y') : 'No especificado' }}<br>
        </div>
        <hr>
        @endforeach
    @else
        <p>No hay proyectos registrados para este comité.</p>
    @endif
    @endforeach
</div>
@endsection
