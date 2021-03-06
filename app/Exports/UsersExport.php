<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::all();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            '#',
            'Rut',
            'Nombre',
            'Apellido',
            'Correo',
            'Verificacion correo',
            'Telefono',
            'Fecha nacimiento',
            'Tipo usuario',
            'Creado el',
            'Actualizado el',
        ];
    }
}
