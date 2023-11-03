<?php

namespace App\Http\Controllers;

use App\Models\Comite;
use App\Models\Proyecto;
use Illuminate\Http\Request;
class ProyectoController extends Controller
{
public function create()
{
    $comites = Comite::all();
    return view('proyectos.create', compact('comites'));
    
}

public function store(Request $request)
{
    $request->validate([
        'Nombre_proyecto' => 'required|string|max:255',
        'Id_comite' => 'required|integer|exists:Comites,Id_comite',
        'Descripcion_proyecto' => 'required|string',
        'Fecha_autorizacion' => 'required|date',
        'Fecha_inicio' => 'required|date',
        'Fecha_fin' => 'required|date',
    ]);

    $user_id = auth()->id();


    $data = array_merge($request->all(), ['id_usuario' => $user_id]);
    Proyecto::create($data);

    return redirect()->route('proyectos.index')->with('success', 'Proyecto creado exitosamente.');
}

public function reporte()
{
    $comites = Comite::with('proyectos')->get();
    return view('proyectos.reporte', compact('comites'));
}
public function index(Request $request)
{
    $user_id = auth()->id();  
    
    $proyectos = Proyecto::where('id_usuario', $user_id)
                         ->get();

    return view('proyectos.index', compact('proyectos'));
}

public function edit($id)
{
    $proyecto = Proyecto::findOrFail($id);
    $comites = Comite::all();
    return view('proyectos.edit', compact('proyecto', 'comites'));
}
public function update(Request $request, $id)
    {
        // Validar los datos del formulario
        $request->validate([
            'Nombre_proyecto' => 'required|string|max:255',
            'Descripcion_proyecto' => 'required|string',
            'Fecha_autorizacion' => 'nullable|date',
            'Fecha_inicio' => 'nullable|date',
            'Fecha_fin' => 'nullable|date',
            'Id_comite' => 'required|exists:comites,Id_comite',
        ]);

        // Encontrar el proyecto por ID
        $proyecto = Proyecto::findOrFail($id);

        // Actualizar los detalles del proyecto con los datos del formulario
        $proyecto->update([
            'Nombre_proyecto' => $request->Nombre_proyecto,
            'Descripcion_proyecto' => $request->Descripcion_proyecto,
            'Fecha_autorizacion' => $request->Fecha_autorizacion,
            'Fecha_inicio' => $request->Fecha_inicio,
            'Fecha_fin' => $request->Fecha_fin,
            'Id_comite' => $request->Id_comite,
        ]);

        // Redirigir al usuario a una página (por ejemplo, una lista de proyectos) con un mensaje de éxito
        return redirect()->route('proyectos.index')->with('success', 'Proyecto actualizado con éxito.');
    }
    public function destroy(Proyecto $proyecto)
{
    $proyecto->delete();
    session()->flash('success', 'Proyecto eliminado exitosamente.');
    return redirect()->route('proyectos.index');
}

}
