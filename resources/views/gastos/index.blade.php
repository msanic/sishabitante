@extends('template.admin')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <a href="{{ route('gastos.create') }}" class="btn btn-primary mb-3">Crear nuevo gasto</a>
            <a href="{{ route('gastos.export') }}">Descargar reporte en Excel</a>


            
            <table class="table table-bordered">
                <thead>
                    <tr>
                        
                        <th>Fecha</th>
                        <th>Descripción</th>
                        <th>Monto</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($gastos as $gasto)
                    <tr>
                    <td>{{ \Carbon\Carbon::parse($gasto->Fecha_gastos)->format('d/m/Y') }}</td>
                        <td>{{ $gasto->Descripcion_gastos }}</td>
                        <td>Q. {{ number_format($gasto->Monto_gastos, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
