@extends('template.admin')

@section('content')
<div class="container mt-5">
    <h1>Editar Proyecto</h1>

    <form action="{{ route('proyectos.update', $proyecto->Id_proyecto) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="Nombre_proyecto">Nombre del Proyecto</label>
            <input type="text" name="Nombre_proyecto" id="Nombre_proyecto" class="form-control" value="{{ $proyecto->Nombre_proyecto }}">
        </div>

        <div class="form-group">
            <label for="Descripcion_proyecto">Descripción del Proyecto</label>
            <textarea name="Descripcion_proyecto" id="Descripcion_proyecto" class="form-control">{{ $proyecto->Descripcion_proyecto }}</textarea>
        </div>

        <div class="form-group">
            <label for="Fecha_autorizacion">Fecha de Autorización</label>
            <input type="date" name="Fecha_autorizacion" id="Fecha_autorizacion" class="form-control" value="{{ $proyecto->Fecha_autorizacion ? $proyecto->Fecha_autorizacion->format('Y-m-d') : '' }}">
        </div>

        <div class="form-group">
            <label for="Fecha_inicio">Fecha de Inicio</label>
            <input type="date" name="Fecha_inicio" id="Fecha_inicio" class="form-control" value="{{ $proyecto->Fecha_inicio ? $proyecto->Fecha_inicio->format('Y-m-d') : '' }}">
        </div>

        <div class="form-group">
            <label for="Fecha_fin">Fecha de Finalización</label>
            <input type="date" name="Fecha_fin" id="Fecha_fin" class="form-control" value="{{ $proyecto->Fecha_fin ? $proyecto->Fecha_fin->format('Y-m-d') : '' }}">
        </div>

        <div class="form-group">
            <label for="Id_comite">Comité</label>
            <select name="Id_comite" id="Id_comite" class="form-control">
                <!-- Aquí deberías llenar el select con los comités disponibles. Ejemplo: -->
                @foreach($comites as $comite)
                    <option value="{{ $comite->Id_comite }}" {{ $comite->Id_comite == $proyecto->Id_comite ? 'selected' : '' }}>{{ $comite->Nombre_comite }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Guardar Cambios</button>
    </form>
</div>
@endsection
