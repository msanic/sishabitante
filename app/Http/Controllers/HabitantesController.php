<?php

namespace App\Http\Controllers;
use App\Models\Habitante;
use Illuminate\Http\Request;
use App\Exports\HabitantesExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;




class HabitantesController extends Controller
{
    // ...

    public function create()
    {
        return view('habitantes.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
           'Nombre_habitante' => 'required|string|max:255',
        'Apellido_habitante' =>'required|string|max:255', // Noté que 'numeric' estaba aquí, lo cambié a 'string'
        'Cui_habitante' => 'required|string|max:13|unique:habitantes',
        'Genero_habitante' => 'nullable|string|max:50',
        'Fechanac_habitante' => 'nullable|date',
        'Paraje' => 'nullable|string|max:255',
    ]);.0
        Habitante::create($data);

        return redirect()->back()->with('success', 'Habitante agregado exitosamente.');
    }

    public function index()
    {
        $habitantes = Habitante::all();
        return view('habitantes.index', compact('habitantes'));
        
        
    }

    public function edit($Id_habitante)
    {
        $habitante = Habitante::find($Id_habitante);

        if ($habitante) {
            return view('habitantes.edit', compact('habitante'));
        } else {
            return redirect()->route('habitantes.index')->with('error', 'Habitante no encontrado');
        }
        
    }
    public function show($id)
    {
        $habitante = Habitante::find($id);
    
        if ($habitante) {
            return view('habitantes.show', compact('habitante'));
        } else {
            return redirect()->route('habitantes.index')->with('error', 'Habitante no encontrado');
        }
    }
    
    public function update(Request $request, $Id_habitante)
    {
        $habitante = Habitante::find($Id_habitante);
        $habitante->update($request->all());
        return redirect()->route('habitantes.index')->with('success', 'Habitante actualizado exitosamente.');
    }

    public function export() 
    {
      
       
        return Excel::download(new HabitantesExport, 'habitantes.xlsx');
    }
    public function destroy($Id_habitante)
    {
        Habitante::find($Id_habitante)->delete();
        return redirect()->route('habitantes.index')->with('success', 'Habitante eliminado exitosamente.');
    }
    
   
public function quejas()
{
    return $this->hasMany(Queja::class, 'Habitante_queja');
}
}
