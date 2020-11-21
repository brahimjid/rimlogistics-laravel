<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\FacturesController;
use App\Http\Controllers\FuelController;
use App\Http\Controllers\IftasController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;


Route::get("/", [TransactionController::class,"index"]);

Route::prefix("iftas")->group(function () {
    Route::get('/import', [IftasController::class, 'index'])->name('ifta.import');
    Route::post('/import', [IftasController::class, 'importe'])->name("iftas.submit");
    Route::get('/{id}',[IftasController::class,'download'])->name('iftas.download');
});

Route::prefix('invoices')->group(function () {
    Route::get("/create", [FacturesController::class,'create'])->name('invoice.create');
    Route::get("/", [FacturesController::class,'index'])->name('invoices');
    Route::get("/{id}", [FacturesController::class,'edit'])->name('invoice.edit');
    Route::post("/delete", [FacturesController::class,'delete'])->name('invoice.delete');
    Route::post("/", [FacturesController::class,'store'])->name('invoice.store');
    Route::put("/", [FacturesController::class,'update'])->name('invoice.update');
    Route::get("/paycheck/weekly", [FacturesController::class,'weeklyPaycheck'])->name('invoice.weekly');
});
Route::prefix('fuel')->group(function () {
    Route::get("/create", [FuelController::class,"create"])->name('fuel.create');
    Route::get("/", [FuelController::class,"index"])->name('fuel');
    Route::post("/", [FuelController::class,"store"])->name('fuel.store');
});

Route::post('import', [TransactionController::class,"import"])->name('import');
Route::get('/export/{id}',[TransactionController::class,'download'])->name('export');

