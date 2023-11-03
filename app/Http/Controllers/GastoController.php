<?php

namespace App\Http\Controllers;

use App\Models\Gasto;
use Illuminate\Http\Request;
use App\Exports\GastosExport;
use Maatwebsite\Excel\Facades\Excel;

class GastoController extends Controller
{
    public function index()
    {
        $user_id = auth()->id();  
       
        $gastos = Gasto::where('id_usuario', $user_id)
                      ->get();
        return view('gastos.index', compact('gastos'));
    }

    public function create()
    {
        return view('gastos.create');
    }
    public function store(Request $request)
    {
    
    
        
        $user_id = auth()->id();
    
        $data = array_merge($request->all(), ['id_usuario' => $user_id]);
        Gasto::create($data);
    
        return redirect()->route('gastos.index');
    }
    
    public function show($id)
    {
        $gasto = Gasto::find($id);
        
        if ($gasto === null) {
            return redirect()->route('gastos.index')
                             ->with('error', 'Gasto no encontrado');
        }
        
        return view('gastos.show', compact('gasto'));
    }
    public function export()
{
    return Excel::download(new GastosExport, 'gastos.xlsx');

}
}


