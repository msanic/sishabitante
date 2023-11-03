<?php

namespace App\Exports;

use App\Models\Gasto; // Asegúrate de que el namespace de tu modelo Gastos es correcto
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class GastosExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        // Obtiene todos los gastos y selecciona sólo las columnas que deseas incluir
        return Gasto::all()->map(function($gasto) {
            return [
                'Fecha_gastos' => $gasto->Fecha_gastos,
                'Descripcion_gastos' => $gasto->Descripcion_gastos,
                'Monto_gastos' => $gasto->Monto_gastos,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Fecha',
            'Descripción',
            'Monto (Q.)',
        ];
    }
}
