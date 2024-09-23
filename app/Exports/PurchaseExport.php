<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PurchaseExport implements FromCollection, WithHeadings
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
                'Code' => $item->code,
                'Material' => $item->material->name,
                'Supplier' => $item->supplier->name,
                'Status' => $item->status->name,
                'Quantity' => $item->quantity,
                'Price' => $item->price,
                'Total' => $item->total,
                'Created At' => $item->created_at,
                'Updated At' => $item->updated_at,
            ];
        });

        return $data;
    }

    public function headings(): array
    {
        return [
            'Code',
            'Material',
            'Supplier',
            'Status',
            'Quantity',
            'Price',
            'Total',
            'Created At',
            'Updated At',
        ];
    }
}
