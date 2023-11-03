<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Habitante;
use Illuminate\Support\Facades\DB;


class InformeController extends Controller
{
    public function habitantesInforme()
    {
        // Paso 3: Número total de habitantes
        $totalHabitantes = Habitante::count();

        // Paso 4: Informe de habitantes por edad
        $habitantesPorEdad = Habitante::select(DB::raw('YEAR(CURRENT_DATE) - YEAR(Fechanac_habitante) AS edad'), DB::raw('count(*) as cantidad'))
            ->groupBy('edad')
            ->orderBy('edad')
            ->get();

        // Paso 5: Informe de habitantes por paraje
        $habitantesPorParaje = Habitante::select('Paraje', DB::raw('count(*) as cantidad'))
            ->groupBy('Paraje')
            ->get();

        return view('informe.habitantes', compact('totalHabitantes', 'habitantesPorEdad', 'habitantesPorParaje'));
    }
}
