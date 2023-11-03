@extends('template.admin')

@section('content')


<div class="container beige-bg">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card custom-card">
                <div class="card-header custom-card-header">FORMULARIO</div>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card-body">
                    <form action="{{ route('habitantes.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="Nombre_habitante">Nombre</label>
                            <input type="text" class="form-control" id="Nombre_habitante" name="Nombre_habitante" required>
                        </div>

                        <div class="form-group">
                            <label for="Apellido_habitante">Apellido</label>
                            <input type="text" class="form-control" id="Apellido_habitante" name="Apellido_habitante" required>
                        </div>

                        <div class="form-group">
                            <label for="Cui_habitante">CUI</label>
                            <input type="text" class="form-control" id="Cui_habitante" name="Cui_habitante" required>
                        </div>

                        <div class="form-group">
                            <label for="Genero_habitante">Género</label>
                            <select class="form-control" id="Genero_habitante" name="Genero_habitante">
                                <option value="Masculino">Masculino</option>
                                <option value="Femenino">Femenino</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="Fechanac_habitante">Fecha de Nacimiento</label>
                            <input type="date" class="form-control" id="Fechanac_habitante" name="Fechanac_habitante">
                        </div>

                        <div class="form-group">
                            <label for="Paraje">Paraje</label>
                            <input type="text" class="form-control" id="Paraje" name="Paraje">
                        </div>

                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
