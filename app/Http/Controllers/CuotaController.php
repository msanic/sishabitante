<?php

namespace App\Http\Controllers;

use App\Models\Cuota;
use App\Models\Habitante;
use App\Models\TipoCuota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Exports\CuotasExport;
use Maatwebsite\Excel\Facades\Excel;


class CuotaController extends Controller
{
    public function create()
    {
        $habitantes = habitante::all();
        $tiposCuota = tipocuota::all();
        return view('cuotas.create', compact('habitantes', 'tiposCuota'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'Id_habitante' => 'required|integer',
            'Id_tipo_cuota' => 'required|integer',
            'Fechacuota' => 'required|date',
            'Monto_cuota' => 'required|numeric',
            'Año_cuota' => 'required|date_format:Y',
        ]);
    
  
        $user_id = auth()->id();
    
     
        $cuota = Cuota::create(array_merge($request->all(), ['id_usuario' => $user_id]));
    
     
        return redirect()->route('cuotas.comprobante', ['id' => $cuota->Id_cuota])->with('success', 'Cuota registrada exitosamente');
    }
    

    public function index()
{
    
    $user_id = auth()->id();


    $cuotas = Cuota::where('id_usuario', $user_id)
                   ->with(['habitante', 'tipocuota'])
                   ->get();

    $años = Cuota::where('id_usuario', $user_id)
                 ->distinct()
                 ->pluck('Año_cuota')
                 ->toArray();
    sort($años);

    return view('cuotas.index', compact('cuotas', 'años'));
}


public function show($id)
{
    $historial = Cuota::where('Id_habitante', $id)->get();
    return view('cuotas.show', compact('historial'));
}
public function historial(Request $request)
{
    $cuotas = [];

    if ($request->has('habitante')) {
        $habitante = $request->input('habitante');

        $habitanteIds = DB::table('habitantes')
            ->where('Nombre_habitante', 'like', '%' . $habitante . '%')
            ->orWhere('Apellido_habitante', 'like', '%' . $habitante . '%')
            ->pluck('Id_habitante');

        $cuotas = Cuota::whereIn('Id_habitante', $habitanteIds)
            ->with('habitante', 'tipoCuota')
            ->get();
    }

    return view('cuotas.historial', compact('cuotas'));
}
public function sugerencias(Request $request)
{
    $term = $request->get('term');
    
    $habitantes = DB::table('habitantes')
                    ->where('nombre', 'like', '%'.$term.'%')
                    ->orWhere('apellido', 'like', '%'.$term.'%')
                    ->get();
    
    return response()->json($habitantes);
}
public function showComprobante($id)
{
    // Obtén los detalles de la cuota usando el ID
    $cuota = Cuota::findOrFail($id);

    // Muestra la vista del comprobante, pasando la información de la cuota
    return view('cuotas.comprobante', compact('cuota'));
}

public function comprobante($id)
{
    $cuota = Cuota::find($id);
    return view('cuotas.comprobante', compact('cuota'));
}
// METODS ELIMNAR EDITAR


public function edit($id)
{
    $cuota = Cuota::find($id);
    $habitantes = habitante::all();  // Recupera todos los habitantes
    $tiposCuota = tipocuota::all();  // Recupera todos los tipos de cuota

    if(!$cuota) {
        return redirect()->route('cuotas.index')->with('error', 'Cuota no encontrada');
    }

    return view('cuotas.edit', compact('cuota', 'habitantes', 'tiposCuota'));  // Pasa la cuota, los habitantes y los tipos de cuota a tu vista
}


public function update(Request $request, $id)
{
    $request->validate([
        'Id_habitante' => 'required|exists:habitantes,Id_habitante', // Asegúrate de que el ID del habitante exista en tu tabla de habitantes
        'Id_tipo_cuota' => 'required|exists:TipoCuota,Id_tipo_cuota', // Asegúrate de que el ID del tipo de cuota exista en tu tabla de tipos de cuotas
        'Fechacuota' => 'required|date',
        'Monto_cuota' => 'required|numeric|min:0',
        'Año_cuota' => 'required|integer|min:2000|max:2099',
    ]);

    $cuota = Cuota::find($id);
    if(!$cuota) {
        return redirect()->route('cuotas.index')->with('error', 'Cuota no encontrada');
    }

    $cuota->Id_habitante = $request->Id_habitante;
    $cuota->Id_tipo_cuota = $request->Id_tipo_cuota;
    $cuota->Fechacuota = $request->Fechacuota;
    $cuota->Monto_cuota = $request->Monto_cuota;
    $cuota->Año_cuota = $request->Año_cuota;

    $cuota->save();

    return redirect()->route('cuotas.index')->with('success', 'Cuota actualizada exitosamente');
}

public function destroy($id)
{
    $cuota = Cuota::find($id);
    if(!$cuota) {
        return redirect()->route('cuotas.index')->with('error', 'Cuota no encontrada');
    }

    $cuota->delete();
    return redirect()->route('cuotas.index')->with('success', 'Cuota eliminada exitosamente');
}

public function export(Request $request)
{
    $año = $request->input('año');
    $user_id = auth()->id(); 

    $cuotas = Cuota::with(['habitante', 'tipoCuota'])
        ->whereYear('Año_cuota', $año)
        ->where('id_usuario', $user_id) 
        ->get(['Id_habitante', 'Id_tipo_cuota', 'Fechacuota', 'Monto_cuota', 'Año_cuota']);

    
       $cuotasWithHabitanteNames = $cuotas->map(function ($cuota) {
        $nombreHabitante = $cuota->habitante->Nombre_habitante;
        $tipoCuota = $cuota->tipoCuota->Descripcion;
        return [
            'Nombre_habitante' => $nombreHabitante,
            'Tipocuota' => $tipoCuota,
            'Fechacuota' => $cuota->Fechacuota,
            'Monto_cuota' => $cuota->Monto_cuota,
            'Año_cuota' => $cuota->Año_cuota
        ];
    });

    $totalMontoCuota = $cuotas->sum('Monto_cuota');

    $cuotasWithHabitanteNames->push(['Nombre_habitante' => '', 'Tipocuota' => '', 'Fechacuota' => 'Total', 'Monto_cuota' => $totalMontoCuota, 'Año_cuota' => '']);

    return Excel::download(new CuotasExport($cuotasWithHabitanteNames), 'cuotas_' . $año . '.xlsx');
}




}