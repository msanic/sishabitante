@extends('template.admin')

@section('content')
<div class="container mt-5">
    <div class="card p-4">
        <h1 class="card-title">Detalles del Documento</h1>

        <div class="card-body">
           
            <p><strong>Nombre:</strong> {{ $documento->Nombre_doc }}</p>
            <p><strong>Fecha del Documento:</strong> {{ $documento->Fechadocumento }}</p>
            <p><strong>Descripción:</strong> {{ $documento->Descripcion }}</p>

            <p><strong>Archivo:</strong>
                <a href="{{ asset('fotos').'/'.$documento->Archivo }}" target="_blank">Ver archivo</a>

            </p>
        </div>

        <div class="card-footer">
            <a href="{{ route('documentos.index') }}" class="btn btn-primary">Volver al listado</a>
        </div>
    </div>
</div>
@endsection
