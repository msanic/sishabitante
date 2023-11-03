<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Matricula;
use Illuminate\Support\Facades\Log;
use App\Models\Habitante;
use App\Exports\MatriculasExport;
use Maatwebsite\Excel\Facades\Excel;



class MatriculaController extends Controller
{
    //

public function create()
{
     $habitantes = Habitante::all();
    return view('matricula.create', compact('habitantes'));
    
}

public function store(Request $request)
{
    try {
        // Valida los datos ingresados en el formulario
        $request->validate([
            'Id_habitante' => 'required|integer|exists:habitantes,Id_habitante',
            'Monto_matricula' => 'required|numeric',
            'Fechamatricula' => 'required|date',
            'Descripcion_matri' => 'required|string',
        ]);

        // Intenta insertar una nueva matrícula en la base de datos
        DB::table('matricula')->insert([
            'Id_habitante' => $request->input('Id_habitante'),
            'Monto_matricula' => $request->input('Monto_matricula'),
            'Fechamatricula' => $request->input('Fechamatricula'),
            'Descripcion_matri' => $request->input('Descripcion_matri'),
            'id_usuario'=>auth()->id(),
        ]);

        // Si la operación fue exitosa, redirige con un mensaje de éxito
        return redirect()->route('matricula.index')->with('success', 'Matrícula registrada con éxito');
    } catch (\Exception $e) {
        // Si ocurre un error durante la inserción, logra el error y redirige con un mensaje de error
        Log::error('Error al crear matrícula: ' . $e->getMessage());

        // Redirige a la misma página con un mensaje de error
        return redirect()->back()->withInput()->with('error', 'No se pudo registrar la matrícula. Por favor, inténtalo de nuevo.');
    }
}


public function index()
{
    $user_id = auth()->id(); 

    
    $matriculas = DB::table('matricula')
        ->join('habitantes', 'matricula.Id_habitante', '=', 'habitantes.Id_habitante')
        ->where('matricula.id_usuario', $user_id)  
        ->select('matricula.*', 'habitantes.Nombre_habitante', 'habitantes.Apellido_habitante')
        ->get();

    $años = Matricula::where('id_usuario', $user_id) 
        ->pluck('Fechamatricula')
        ->map(function ($fecha) {
            return \Carbon\Carbon::parse($fecha)->format('Y');
        })
        ->unique()
        ->sort()
        ->toArray();

    return view('matricula.index', compact('matriculas', 'años'));
}
    



public function show($id)
{
    $historial = Matricula::where('Id_habitante', $id)->get();
    return view('matricula.show', compact('historial'));

   
}
public function historial(Request $request)
{
   
    $matriculas = [];

    if ($request->has('habitante')) {
        $habitante = $request->input('habitante');

        $habitanteIds = DB::table('habitantes')
            ->where('Nombre_habitante', 'like', '%' . $habitante . '%')
            ->orWhere('Apellido_habitante', 'like', '%' . $habitante . '%')
            ->pluck('Id_habitante');

        $matriculas = Matricula::whereIn('Id_habitante', $habitanteIds)
            ->with('habitante')
            ->get();
    }

    return view('matricula.historial', compact('matriculas'));
}
   
   



public function edit($id)
{
    $habitantes = DB::table('Habitantes')->select('Id_habitante', 'Nombre_habitante', 'Apellido_habitante')->get();
    $matricula = DB::table('Matricula')->where('Id_matricula', $id)->first();

    if (!$matricula) {
        return redirect()->route('matricula.index')->with('error', 'Matrícula no encontrada');
    }

    return view('matricula.edit', compact('matricula', 'habitantes'));
}
public function update(Request $request, $id)
{
    try {
        // Valida los datos ingresados en el formulario
        $request->validate([
            'Id_habitante' => 'required|integer|exists:Habitantes,Id_habitante',
            'Monto_matricula' => 'required|numeric',
            'Fechamatricula' => 'required|date',
            'Descripcion_matri' => 'required|string',
        ]);

        // Encuentra la matrícula por ID y actualiza sus datos
        DB::table('Matricula')
            ->where('Id_matricula', $id)
            ->update([
                'Id_habitante' => $request->input('Id_habitante'),
                'Monto_matricula' => $request->input('Monto_matricula'),
                'Fechamatricula' => $request->input('Fechamatricula'),
                'Descripcion_matri' => $request->input('Descripcion_matri'),
            ]);

        // Si la operación fue exitosa, redirige con un mensaje de éxito
        return redirect()->route('matricula.index')->with('success', 'Matrícula actualizada con éxito');
    } catch (\Exception $e) {
        // Si ocurre un error durante la actualización, logra el error y redirige con un mensaje de error
        Log::error('Error al actualizar matrícula: ' . $e->getMessage());

        // Redirige a la misma página con un mensaje de error
        return redirect()->back()->withInput()->with('error', 'No se pudo actualizar la matrícula. Por favor, inténtalo de nuevo.');
    }
}
public function destroy($id)
{
    try {
        // Encuentra la matrícula por ID y la elimina
        DB::table('Matricula')->where('Id_matricula', $id)->delete();

        // Si la operación fue exitosa, redirige con un mensaje de éxito
        return redirect()->route('matricula.index')->with('success', 'Matrícula eliminada con éxito');
    } catch (\Exception $e) {
        // Si ocurre un error durante la eliminación, registra el error y redirige con un mensaje de error
        Log::error('Error al eliminar matrícula: ' . $e->getMessage());

        // Redirige a la misma página con un mensaje de error
        return redirect()->back()->with('error', 'No se pudo eliminar la matrícula. Por favor, inténtalo de nuevo.');
    }
}

public function export(Request $request)
{
    $año = $request->input('año');
    $user_id = auth()->id(); 
    $matriculas = Matricula::with(['habitante'])
        ->whereYear('Fechamatricula', $año)
        ->where('id_usuario', $user_id) 
        ->get(['Id_habitante', 'Monto_matricula', 'Fechamatricula', 'Descripcion_matri']);

    
       $matriculaswith = $matriculas->map(function ($matricula) {
        $nombreHabitante = $matricula->habitante->Nombre_habitante;
        return [
            'Nombre_habitante' => $nombreHabitante,
            'Monto_matricula' => $matricula->Monto_matricula,
            'Fechamatricula' => $matricula->Fechamatricula,
            'Descripcion_matri' => $matricula->Descripcion_matri
        ];
    });

    $totalMontoMatricula = $matriculas->sum('Monto_matricula');

    $matriculaswith->push(['Nombre_habitante' => 'Total','Monto_matricula' => $totalMontoMatricula, 'Fechamatricula' => '', 'Fechamatricula' => '','Descripcion_matri' => '']);

    return Excel::download(new MatriculasExport($matriculaswith), 'matriculas_' . $año . '.xlsx');
}


}