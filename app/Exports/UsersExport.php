<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class UsersExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    use Exportable;

    public function collection()
    {
        return User::all();
    }

    public function headings() : array
    {
        return [
            '#',
            'username',
            'role',
            'status',
            'created by',
            'updated by',
            'created at',
            'updated at',
        ];
    }

}
