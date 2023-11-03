<?php

namespace App\Exports;

use App\Models\Habitante;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
class HabitantesExport implements FromCollection, WithHeadings
{
public function collection()
    {
        // Obtiene todos los gastos y selecciona sólo las columnas que deseas incluir
        return Habitante::all()->map(function($habitante) {
            return [
                'Nombre_habitante' => $habitante->Nombre_habitante,
                'Apellido_habitante' => $habitante->Apellido_habitante,
                'Cui_habitante' => $habitante->Cui_habitante,
                'Genero_habitante' => $habitante->Genero_habitante,
                'Fechanac_habitante' => $habitante->Fechanac_habitante,
                'Paraje' => $habitante->Paraje,

            ];
        });
    }

    public function headings(): array
    {
        return [
        'Nombre',
        'Apellido',
        'Cui',
        'Genero',
        'Fechanacimiento',
        'Paraje',
        ];
    }
}


