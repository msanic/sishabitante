@extends('template.admin')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif


@section('content')
<div class="container mt-5">
    <h1>Crear Nuevo Proyecto</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> Hay algunos problemas con tu entrada.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('proyectos.store') }}" method="POST">
        @csrf

        <div class="form-group">
    <label for="Nombre_proyecto">Nombre del proyecto</label>
    <input type="text" class="form-control" name="Nombre_proyecto" id="Nombre_proyecto" required>
</div>

    
        <div class="form-group">
    <label for="Id_comite">Comité</label>
    <select class="form-control" name="Id_comite" id="Id_comite">
        @foreach($comites as $comite)
            <option value="{{ $comite->Id_comite }}">{{ $comite->Nombre_comite }}</option>
        @endforeach
    </select>
</div>

        <div class="mb-3">
            <label for="Descripcion_proyecto" class="form-label">Descripción del Proyecto</label>
            <textarea name="Descripcion_proyecto" class="form-control" id="Descripcion_proyecto" rows="3"></textarea>
        </div>

        <div class="mb-3">
            <label for="Fecha_autorizacion" class="form-label">Fecha de Autorización</label>
            <input type="date" name="Fecha_autorizacion" class="form-control" id="Fecha_autorizacion">
        </div>

        <div class="form-group">
    <label for="Fecha_inicio">Fecha de inicio</label>
    <input type="date" class="form-control" name="Fecha_inicio" id="Fecha_inicio" required>
    
</div>

<div class="form-group">
    <label for="Fecha_fin">Fecha de fin</label>
    <input type="date" class="form-control" name="Fecha_fin" id="Fecha_fin" required>
</div>

        <button type="submit" class="btn btn-primary">Crear Proyecto</button>
    </form>
</div>
@endsection
