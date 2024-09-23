<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\WarehouseController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */

Route::get('/', [AuthController::class, 'index'])->name('auth.index');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::delete('/logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::prefix("/")->middleware('auth')->group(function () {
    Route::get('/purchase', [PurchaseController::class, "index"])->name('purchase.index');
    Route::get("/purchase/export", [PurchaseController::class, "export"])->name("purchase.export");
    Route::post('/purchase/create', [PurchaseController::class, "create"])->name('purchase.create');
    Route::put('/purchase/update/{id}', [PurchaseController::class, "update"])->name('purchase.update');
    Route::delete('/purchase/delete/{id}', [PurchaseController::class, "delete"])->name('purchase.delete');
    Route::put('/purchase/approve/{id}', [PurchaseController::class, "approve"])->name('purchase.approve');
    Route::put('/purchase/reject/{id}', [PurchaseController::class, "reject"])->name('purchase.reject');

    Route::get("/warehouse", [WarehouseController::class, "index"])->name('warehouse.index');
    Route::get("/warehouse/export", [WarehouseController::class, "export"])->name('warehouse.export');
});
