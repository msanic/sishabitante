@extends('template.admin')

@section('content')
<style>
    .container {
        background-color: #f5f5dc; /* Fondo beige */
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
    }

    .form-label {
        font-weight: bold;
    }

    .btn-primary {
        background-color: #007bff; /* Azul */
        border: none;
    }

    .btn-primary:hover {
        background-color: #0056b3; /* Azul más oscuro al pasar el cursor */
    }

    .btn-secondary {
        background-color: #6c757d; /* Gris */
        border: none;
    }

    .btn-secondary:hover {
        background-color: #5a6268; /* Gris más oscuro al pasar el cursor */
    }
</style>

<div class="container mt-5">
    <h1 class="mb-4">Editar</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('bienes.update', $bien->Id_bien) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="Nombre_bien" class="form-label">Nombre del bien</label>
            <input type="text" class="form-control" id="Nombre_bien" name="Nombre_bien" value="{{ $bien->Nombre_bien }}" required>
        </div>

        <div class="mb-3">
            <label for="Descripcion_bien" class="form-label">Descripción</label>
            <textarea class="form-control" id="Descripcion_bien" name="Descripcion_bien" rows="3" required>{{ $bien->Descripcion_bien }}</textarea>
        </div>

        <div class="mb-3">
            <label for="Fecha_ingreso" class="form-label">Fecha de ingreso</label>
            <input type="date" class="form-control" id="Fecha_ingreso" name="Fecha_ingreso" value="{{ $bien->Fecha_ingreso }}" required>
        </div>

        <div class="mb-3">
            <label for="Valor_bien" class="form-label">Valor del bien</label>
            <input type="number" step="0.01" class="form-control" id="Valor_bien" name="Valor_bien" value="{{ $bien->Valor_bien }}" required>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-4">
            <button type="submit" class="btn btn-primary">Guardar cambios</button>
            <a href="{{ route('bienes.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection
