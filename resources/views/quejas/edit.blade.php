@extends('template.admin')

@section('content')
    <div class="container mt-5">
        <h1>Editar Queja</h1>
        <form action="{{ route('quejas.update', $queja->Id_queja) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="fecha_queja">Fecha de la Queja:</label>
                <input type="date" name="fecha_queja" class="form-control" value="{{ $queja->Fecha_queja }}" required>
            </div>
            <div class="form-group">
                <label for="habitante_queja">Quejador:</label>
                <select name="habitante_queja" class="form-control" required>
                    @foreach($habitantes as $habitante)
                        <option value="{{ $habitante->Id_habitante }}" {{ $queja->Habitante_queja == $habitante->Id_habitante ? 'selected' : '' }}>
                            {{ $habitante->Nombre_habitante }} {{ $habitante->Apellido_habitante }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="habitante_quejado">Habitante:</label>
                <select name="habitante_quejado" class="form-control" required>
                    @foreach($habitantes as $habitante)
                        <option value="{{ $habitante->Id_habitante }}" {{ $queja->Habitante_quejado == $habitante->Id_habitante ? 'selected' : '' }}>
                            {{ $habitante->Nombre_habitante }} {{ $habitante->Apellido_habitante }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="descripcion_queja">Descripción de la Queja:</label>
                <textarea name="descripcion_queja" class="form-control" required>{{ $queja->Descripcion_queja }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar Queja</button>
        </form>
    </div>
@endsection