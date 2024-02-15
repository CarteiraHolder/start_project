<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ArrayExport implements FromCollection, WithHeadings, WithStyles
{
    use Exportable;

    private array $array;
    private array $headings;

    public function __construct($array)
    {
        $this->array = $array;
        $this->headings = array_keys($array[0]);
    }

    public function collection()
    {
        return collect($this->array);
    }

    public function headings(): array
    {
        return $this->headings;
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],
        ];
    }

    public function Export(): mixed
    {
    }
}
