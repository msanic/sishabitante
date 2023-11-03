@extends('template.admin')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header"><h1 class="text-center">Crear Nuevo Comité</h1></div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> Hay algunos problemas con tus entradas.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('comites.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="Nombre_comite" class="form-label">Nombre del Comité</label>
                            <input type="text" name="Nombre_comite" class="form-control" id="Nombre_comite" placeholder="Nombre del comité" required>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Crear Comité</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
