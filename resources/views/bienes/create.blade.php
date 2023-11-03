@extends('template.admin')

@section('content')
<style>
    body {
        background-color: #f5f5dc; /* Color beige de fondo */
    }
</style>
<div class="container mt-4">
    <h1>Registrar nuevo Bien</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('bienes.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="Nombre_bien" class="form-label">Nombre del bien</label>
            <input type="text" class="form-control" id="Nombre_bien" name="Nombre_bien" required>
        </div>

        <div class="mb-3">
            <label for="Descripcion_bien" class="form-label">Descripción</label>
            <textarea class="form-control" id="Descripcion_bien" name="Descripcion_bien" rows="3" required></textarea>
        </div>

        <div class="mb-3">
            <label for="Valor_bien" class="form-label">Valor del bien</label>
            <input type="text" class="form-control" id="Valor_bien" name="Valor_bien" required>
        </div>

        <div class="mb-3">
            <label for="Fecha_ingreso" class="form-label">Fecha de ingreso</label>
            <input type="date" class="form-control" id="Fecha_ingreso" name="Fecha_ingreso" required>
        </div>

        <!-- Si tienes más campos, agrégales aquí -->

        <button type="submit" class="btn btn-primary">Registrar</button>
    </form>
</div>
@endsection
