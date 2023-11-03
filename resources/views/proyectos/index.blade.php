@extends('template.admin')
@section('title','LISTA DE PROYECTOS')
<title>productos</title>
@section('header')
<a href="{{ route('proyectos.create') }}" class="btn btn-info"><i class="fa fa-fw fa-plus"></i>Nuevo</a> 
@endsection

@section('content')

<div class="table-responsive">
<table id="example2" class="table table-bordered table-striped">
        <thead class="">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Comité</th>
                <th>Descripción</th>
                <th>Fecha autorización</th>
                <th>Fecha inicio</th>
                <th>Fecha fin</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @php $i=1; @endphp
            @foreach($proyectos as $proyecto)
            <tr>
                <td> {{$i++}} </td>
                <td> {{$proyecto->Nombre_proyecto}} </td>
                <td> {{$proyecto->comite->Nombre_comite}} </td>
                <td> {{$proyecto->Descripcion_proyecto}} </td>
                <td>{{ \Carbon\Carbon::parse($proyecto->Fecha_autorizacion)->format('d/m/Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($proyecto->Fecha_inicio)->format('d/m/Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($proyecto->Fecha_fin)->format('d/m/Y') }}</td>
                <td> 
                    @php
                    $fechaFin = \Carbon\Carbon::parse($proyecto->Fecha_fin);
                    $hoy = \Carbon\Carbon::now();
            
                    if ($fechaFin->lte($hoy)) {
                        echo '<span class="badge badge-danger">Finalizado</span>';
                    } else {
                        echo '<span class="badge badge-success">Pendiente</span>';
                    }
                @endphp
                 </td>
                <td>
                <a href="{{ route('proyectos.edit',$proyecto->Id_proyecto ) }}" class="btn btn-primary"><i class="fa fa-fw fa-edit"></i></a>
                <form action="{{ route('proyectos.destroy', $proyecto->Id_proyecto) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este proyecto?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"><i class="fa fa-fw fa-trash"></i></button>
                </form>  
                </td>
            </tr>

            @endforeach
        </tbody>
    </table>
</div>


@endsection