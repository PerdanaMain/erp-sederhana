<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MaterialExport implements FromCollection, WithHeadings
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        $data = $this->data;
        $data = $data->map(function ($item) {
            return [
                'Name' => $item->name,
                'Stock' => $item->stock,
                'Updated At' => $item->updated_at,
            ];
        });

        return $data;
    }

    public function headings(): array
    {
        return [
            'Name',
            'Stock',
            'Updated At',
        ];
    }
}
