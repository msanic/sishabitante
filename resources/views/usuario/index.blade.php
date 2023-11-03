@extends('template.admin')
@section('title','LISTA DE USUARIOS')
<title>usuarios</title>
@section('header')
<button type="button" href="{{route('usuarios.create')}}" class="btn btn-info" data-toggle="modal" data-target="#create">
<i class="fa fa-fw fa-plus"></i> Nuevo</button> 
@endsection

@section('content')

<div class="table-responsive">
<table id="example2" class="table table-bordered table-striped">
        <thead class="bg-navy">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Rol</th>
                <th>Foto</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i=1;
            @endphp
            @foreach($usuarios as $usuario)
            <tr>
                <td> {{$i++}} </td>
                <td> {{$usuario->name}} </td>
                <td> {{$usuario->email}} </td>
                <td> {{$usuario->rol}} </td>
                <td> <img src="{{ asset('loginfoto').'/'.$usuario->foto}}" alt="" width="50px" height="50px"> </td>
                
                <td>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit{{$usuario->id}}"><i class="fa fa-fw fa-edit"></i>
                </button>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete{{$usuario->id}}"><i class="fa fa-fw fa-trash"></i>

                </button>
                    
                </td>
            </tr>
            @include('usuario.info')

            @endforeach
        </tbody>
    </table>
</div>

@include('usuario.create')

@endsection