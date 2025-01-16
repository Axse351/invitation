<?php

namespace App\Exports;

use App\Models\Event;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EventExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Event::all(); // Ambil semua data event
    }

    public function headings(): array
    {
        return [
            'Nomor Antrian',
            'Nama',
            'Alamat',
            'No HP',
            'Sales',
            'SH',
            'Brand'
        ];
    }
}
