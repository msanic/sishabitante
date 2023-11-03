<?php

namespace App\Http\Controllers;
use App\Models\Bien;
use Illuminate\Http\Request;


class BienController extends Controller
{
    public function index()
    {
        $user_id = auth()->id();  
       
        $bienes = Bien::where('id_usuario', $user_id)
                      ->get();
    
        return view('bienes.index', compact('bienes'));
    }
    

    
    public function create()
    {
        return view('bienes.create');
    }
    
    public function store(Request $request)
{
    $request->validate([
        'Nombre_bien' => 'required|max:255',
        'Descripcion_bien' => 'required',
        'Fecha_ingreso' => 'required|date',
        'Valor_bien' => 'required|numeric',
        
    ]);

    $bien = new Bien();
    $bien->Nombre_bien = $request->Nombre_bien;
    $bien->Descripcion_bien = $request->Descripcion_bien;
    $bien->Valor_bien = $request->Valor_bien;
    $bien->Fecha_ingreso = $request->Fecha_ingreso;
    $bien->id_usuario=auth()->id();

    $bien->save();

    return redirect()->route('bienes.index')->with('success', 'Bien registrado exitosamente.');
}

public function edit($id)
{
    $bien = Bien::find($id);
    return view('bienes.edit', compact('bien'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'Nombre_bien' => 'required|max:255',
        'Descripcion_bien' => 'required',
        'Fecha_ingreso' => 'required|date',
        'Valor_bien' => 'required|numeric',
    ]);

    $bien = Bien::find($id);
    $bien->update($request->all());

    return redirect()->route('bienes.index')->with('success', 'Bien actualizado exitosamente.');
}

public function destroy($id)
{
    $bien = Bien::find($id);
    $bien->delete();

    return redirect()->route('bienes.index')->with('success', 'Bien eliminado exitosamente.');
}

public function show($id)
{
    $bien = Bien::find($id);

    if (!$bien) {
        return redirect()->route('bienes.index')->with('error', 'Bien no encontrado');
    }

    return view('bienes.show', compact('bien'));
}

}
    