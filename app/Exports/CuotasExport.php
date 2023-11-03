<?php

namespace App\Exports;

use App\Models\Cuota;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class CuotasExport implements FromCollection,WithHeadings
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
            'Tipo',
            'Fecha',
            'Monto',
            'Año'
        ];
    }
    public function collection()
    {
        
        return $this->año;

    }

 
    
}
