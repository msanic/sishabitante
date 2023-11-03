<?php

namespace App\Exports;

use App\Models\Matricula;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MatriculasExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $año;

    public function __construct($año)
    {
        $this->año = $año;
    }
    public function headings(): array
    {
        return [
            'Habitante',
            'Monto',
            'Fecha',
            'Descripción',

        ];
    }
    public function collection()
    {
        return $this->año;
    }
}
