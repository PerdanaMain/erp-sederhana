<?php

namespace App\Http\Controllers;

use App\Exports\PurchaseExport;
use App\Models\Material;
use App\Models\Purchase;
use App\Models\Status;
use App\Models\Supplier;
use Illuminate\Routing\Controller;
use Maatwebsite\Excel\Facades\Excel;

class PurchaseController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::all();
        $statuses = Status::all();
        $materials = Material::all();

        $purchases = Purchase::with('material', 'supplier', 'status')->get();

        return view(
            'purchase',
            compact('suppliers', 'statuses', "materials", "purchases")
        );
    }

    public function export()
    {
        try {
            request()->validate([
                "format" => 'required',
            ]);

            $format = (int) request('format');
            $purchases = Purchase::with('material', 'supplier', 'status')
                ->get();

            if ($purchases->isEmpty()) {
                return back()->with('error', 'No data found');
            }

            if ($format == 1) {
                return Excel::download(new PurchaseExport($purchases), 'purchase-' . time() . '.xlsx');

            } else {
                $pdf = \PDF::loadView('exports.purchase', compact('purchases'))
                    ->setPaper('a4', 'landscape');
                return $pdf->download('purchase-' . time() . '.pdf');

            }

        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function create()
    {
        try {
            request()->validate([
                'supplierId' => 'required',
                'materialId' => 'required',
                'statusId' => 'required',
                'quantity' => 'required',
                'price' => 'required',
            ]);
            Purchase::create([
                'supplierId' => (int) request('supplierId'),
                'materialId' => (int) request('materialId'),
                'statusId' => (int) request('statusId'),
                "code" => "P-" . time(),
                'quantity' => (int) request('quantity'),
                'price' => (int) request('price'),
                "total" => (int) request('quantity') * request('price'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return back()->with('success', 'Material created successfully');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function update($id)
    {
        try {
            request()->validate([
                'supplierId' => 'required',
                'materialId' => 'required',
                'statusId' => 'required',
                'quantity' => 'required',
                'price' => 'required',
            ]);

            $purchase = Purchase::find($id);
            $purchase->update([
                'supplierId' => (int) request('supplierId'),
                'materialId' => (int) request('materialId'),
                'statusId' => (int) request('statusId'),
                'quantity' => (int) request('quantity'),
                'price' => (int) request('price'),
                "total" => (int) request('quantity') * request('price'),
                'updated_at' => now(),
            ]);

            return back()->with('success', 'Material updated successfully');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $purchase = Purchase::find($id);
            $purchase->delete();

            return response()->json([
                'message' => 'Material deleted successfully',
            ])->setStatusCode(200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
            ])->setStatusCode(500);
        }
    }

    public function approve($id)
    {
        try {
            $user = auth()->user();
            if (!in_array($user->roleId, [2, 3])) {
                return response()->json([
                    'message' => 'You are not authorized to reject this material',
                ])->setStatusCode(401);
            }

            $purchase = Purchase::with(
                'material',
                'supplier',
                'status'
            )->find($id);
            $purchase->update([
                'statusId' => 2,
                'updated_at' => now(),
            ]);

            $purchase->material->update([
                'stock' => $purchase->material->stock + $purchase->quantity,
                'updated_at' => now(),
            ]);

            return response()->json([
                'message' => 'Material approved successfully',
            ])->setStatusCode(200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
            ])->setStatusCode(500);
        }
    }

    public function reject($id)
    {
        try {
            $user = auth()->user();
            if (!in_array($user->roleId, [2, 3])) {
                return response()->json([
                    'message' => 'You are not authorized to reject this material',
                ])->setStatusCode(401);
            }

            $purchase = Purchase::find($id);
            $purchase->update([
                'statusId' => 3,
                'updated_at' => now(),
            ]);

            return response()->json([
                'message' => 'Material rejected successfully',
            ])->setStatusCode(200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
            ])->setStatusCode(500);
        }
    }
}
