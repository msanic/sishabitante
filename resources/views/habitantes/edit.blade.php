@extends('template.admin')

@section('content')
<style>
    .beige-bg {
        background-color: #f5f5dc; /* Color beige de fondo */
        color: #333; /* Color de texto legible */
    }

    .form-container {
        background-color: #fff; /* Fondo blanco */
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .form-title {
        font-size: 24px;
        margin-bottom: 20px;
    }
</style>

<div class="container mt-5 beige-bg">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="form-container">
                <h1 class="form-title">Editar Habitante</h1>

                <form action="{{ route('habitantes.update', $habitante->Id_habitante) }}" method="POST">
                    @csrf
                    @method('PUT')
                   
                    <div class="mb-3">
                        <label for="Nombre_habitante" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="Nombre_habitante" name="Nombre_habitante" value="{{ old('Nombre_habitante', $habitante->Nombre_habitante) }}">
                    </div>

                    <div class="mb-3">
                        <label for="Apellido_habitante" class="form-label">Apellido</label>
                        <input type="text" class="form-control" id="Apellido_habitante" name="Apellido_habitante" value="{{ old('Apellido_habitante', $habitante->Apellido_habitante) }}">
                    </div>

                    <div class="mb-3">
                        <label for="Cui_habitante" class="form-label">CUI</label>
                        <input type="text" class="form-control" id="Cui_habitante" name="Cui_habitante" value="{{ old('Cui_habitante', $habitante->Cui_habitante) }}">
                    </div>

                    <div class="mb-3">
                        <label for="Genero_habitante" class="form-label">Género</label>
                        <select class="form-control" id="Genero_habitante" name="Genero_habitante">
                            <option value="Masculino" {{ old('Genero_habitante', $habitante->Genero_habitante) == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                            <option value="Femenino" {{ old('Genero_habitante', $habitante->Genero_habitante) == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="Fechanac_habitante" class="form-label">Fecha de Nacimiento</label>
                        <input type="date" class="form-control" id="Fechanac_habitante" name="Fechanac_habitante" value="{{ old('Fechanac_habitante', $habitante->Fechanac_habitante) }}">
                    </div>

                    <div class="mb-3">
                        <label for="Paraje" class="form-label">Paraje</label>
                        <input type="text" class="form-control" id="Paraje" name="Paraje" value="{{ old('Paraje', $habitante->Paraje) }}">
                    </div>

                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection