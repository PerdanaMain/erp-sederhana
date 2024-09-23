<?php

namespace App\Http\Controllers;

use App\Exports\MaterialExport;
use App\Http\Controllers\Controller;
use App\Models\Material;
use Maatwebsite\Excel\Facades\Excel;

class WarehouseController extends Controller
{
    public function index()
    {
        $materials = Material::with(
            [
                "purchases",
            ]
        )->get();

        return view(
            'warehouse',
            compact('materials')
        );
    }

    public function export()
    {
        try {
            request()->validate([
                "format" => 'required',
            ]);

            $format = (int) request('format');

            $materials = Material::with(
                [
                    "purchases",
                ]
            )->get();

            if ($materials->isEmpty()) {
                return back()->with('error', 'No data found');
            }

            if ($format == 1) {
                return Excel::download(new MaterialExport($materials), 'warehouse-' . time() . '.xlsx');

            } else {
                $pdf = \PDF::loadView('exports.material', compact('materials'))
                    ->setPaper('a4', 'landscape');
                return $pdf->download('warehouse-' . time() . '.pdf');

            }
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
