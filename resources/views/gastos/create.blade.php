@extends('template.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Agregar Nuevo Gasto</div>

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
                    <form action="{{ route('gastos.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="Fecha_gastos">Fecha:</label>
                            <input type="date" class="form-control" id="Fecha_gastos" name="Fecha_gastos" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="Descripcion_gastos">Descripción:</label>
                            <textarea class="form-control" id="Descripcion_gastos" name="Descripcion_gastos" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="Monto_gastos">Monto:</label>
                            <input type="number" class="form-control" step="0.01" id="Monto_gastos" name="Monto_gastos" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
