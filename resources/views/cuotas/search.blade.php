@extends('template.admin')

@section('content')
<div class="container mt-5">
    <form action="{{ route('cuotas.searchResults') }}" method="GET">
        <div class="mb-3">
            <input type="text" name="query" class="form-control" placeholder="Buscar habitante por nombre, apellido, etc.">
        </div>
        <button type="submit" class="btn btn-primary">Buscar</button>
    </form>
</div>
@endsection
