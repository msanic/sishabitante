@extends('template.admin')

@section('content')
<div class="container mt-5" style="background-color: beige; padding: 20px; border-radius: 10px;">
    <h1 class="mb-4">Historial</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('matricula.historial') }}" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="habitante" class="form-control" placeholder="Buscar habitante por nombre" value="{{ request('habitante') }}">
           
            <button type="submit" class="btn btn-primary">Buscar</button>
        </div>
    </form>

  
        <table class="table table-bordered">
            <thead class="bg-primary text-white">
                <tr>
                <th> Nombre Habitante</th>
                <th>Monto Matrícula</th>
                <th>Fecha Matrícula</th>
                <th>Descripción</th>
               
            </tr>
        </thead>
        <tbody>
        @foreach($matriculas as $matricula)
                <tr>
                    
                
                    <td>{{ $matricula->habitante->Nombre_habitante }} {{ $matricula->habitante->Apellido_habitante }}</td>
                    <td>{{ $matricula->Monto_matricula }}</td>
                    <td>{{ \Carbon\Carbon::parse($matricula->Fechamatricula)->format('d/m/Y') }}</td>
                    <td>{{ $matricula->Descripcion_matri }}</td>
                    <td>
                        <a href="{{ route('matricula.edit', $matricula->Id_matricula) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('matricula.destroy', $matricula->Id_matricula) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </td>
                        <td>
                @endforeach
@endsection