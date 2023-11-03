@extends('template.admin')

@section('content')
<div class="container mt-4" style="background-color: beige; padding: 20px; border-radius: 10px;">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <h1 class="mb-4">Editar Documento</h1>

    <form action="{{ route('documentos.update',$documento->Id_documento) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="Nombre_doc">Nombre del Documento</label>
            <input type="text" name="Nombre_doc" id="Nombre_doc" class="form-control" required value="{{$documento->Nombre_doc}}">
        </div>

        <div class="form-group">
            <label for="Fechadocumento">Fecha del Documento</label>
            <input type="date" name="Fechadocumento" id="Fechadocumento" class="form-control" required value="{{$documento->Fechadocumento}}">
        </div>

        <div class="form-group">
            <label for="Descripcion">Descripción</label>
            <textarea name="Descripcion" id="Descripcion" class="form-control" rows="4">{{$documento->Descripcion}}</textarea>
        </div>

        <div class="form-group">
            <label for="Archivo">Subir Archivo</label>
            <input type="file" name="Archivo" id="Archivo" class="form-control" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png" required>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection
