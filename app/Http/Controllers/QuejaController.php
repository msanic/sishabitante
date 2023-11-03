<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Queja;
use App\Models\Habitante;
use RealRashid\SweetAlert\Facades\Alert;


class QuejaController extends Controller
{
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'fecha_queja' => 'required',
            'habitante_queja' => 'required',
            'habitante_quejado' => 'nullable',
            'descripcion_queja' => 'required',
        ]);

        // Crear una nueva instancia de Queja
        $queja = new Queja;

        // Asignar los valores de los campos del formulario a las propiedades del modelo
        $queja->Fecha_queja = $request->fecha_queja;
        $queja->Habitante_queja = $request->habitante_queja;
        $queja->Habitante_quejado = $request->habitante_quejado;
        $queja->Descripcion_queja = $request->descripcion_queja;
        $queja->id_usuario = auth()->id();

        // Guardar la queja en la base de datos
        $queja->save();

        // Redirigir al índice de las quejas (puedes cambiar 'quejas.index' por la ruta que corresponda en tu proyecto)
        return redirect()->route('quejas.index')->with('success', 'Queja creada exitosamente.');
    }

    public function index(Request $request)
{
    $user_id = auth()->id();
    $search = $request->get('search');
    $searchType = $request->get('search_type'); // Obtener el tipo de búsqueda seleccionado

    $quejas = Queja::where('id_usuario', $user_id);

    if ($search) {
        if ($searchType === 'quejador') {
            $quejas->whereHas('habitante', function($query) use ($search) {
                $query->where('Nombre_habitante', 'like', "%{$search}%")
                      ->orWhere('Apellido_habitante', 'like', "%{$search}%");
            });
        } elseif ($searchType === 'quejado') {
            $quejas->whereHas('habitante_quejado', function($query) use ($search) {
                $query->where('Nombre_habitante', 'like', "%{$search}%")
                      ->orWhere('Apellido_habitante', 'like', "%{$search}%");
            });
        }
    }

    $quejas = $quejas->get();

    return view('quejas.index', compact('quejas', 'search', 'searchType'));
}


public function create()
{
    $habitantes = Habitante::all();
    return view('quejas.create', compact('habitantes'));
}


public function edit($id)
{
    $queja = Queja::findOrFail($id);
    $habitantes = Habitante::all();
    return view('quejas.edit', compact('queja', 'habitantes'));
}

public function update(Request $request, $id)
{
    // Validar los datos del formulario
    $request->validate([
        'fecha_queja' => 'required',
        'habitante_queja' => 'required',
        'habitante_quejado' => 'required',
        'descripcion_queja' => 'required',
    ]);

    // Buscar la queja por su ID
    $queja = Queja::findOrFail($id);

    // Actualizar los valores de los campos del formulario en el modelo
    $queja->Fecha_queja = $request->fecha_queja;
    $queja->Habitante_queja = $request->habitante_queja;
    $queja->Habitante_quejado = $request->habitante_quejado;
    $queja->Descripcion_queja = $request->descripcion_queja;

    // Guardar los cambios en la base de datos
    $queja->save();

    // Redirigir al índice de las quejas (puedes cambiar 'quejas.index' por la ruta que corresponda en tu proyecto)
    return redirect()->route('quejas.index')->with('success', 'Queja actualizada exitosamente.');
}

public function show($id)
{
    $queja = Queja::findOrFail($id);
    return view('quejas.show', compact('queja'));
}

public function destroy($id)
{
    Queja::find($id)->delete();
    return redirect()->route('quejas.index')->with('success', 'Queja eliminada exitosamente.');
}

public function historial(Request $request)
{
    $search = $request->get('search');
    $quejas = collect();
    $searchPerformed = false;

    if($search) {
        $searchPerformed = true;
        $habitante = Habitante::where('Nombre_habitante', 'like', '%' . $search . '%')
                              ->orWhere('Apellido_habitante', 'like', '%' . $search . '%')
                              ->first();

        if($habitante) {
            $quejas = $habitante->quejas;
        }
    }

    return view('quejas.historial', compact('quejas', 'searchPerformed'));
}
}
