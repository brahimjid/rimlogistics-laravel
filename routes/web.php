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
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Route;


Route::get("/", [TransactionController::class,"index"])->middleware('auth');
//Route::get('j',[IftasController::class,'test']);
//Route::get("/p", [FacturesController::class,"pc"])->name('paycheck');

Route::middleware('auth')->prefix("iftas")->group(
    function (){
    Route::get('/import', [IftasController::class, 'index'])->name('ifta.import');
    Route::post('/import', [IftasController::class, 'importe'])->name("iftas.submit");
    Route::get('/{id}',[IftasController::class,'download'])->name('iftas.download');
});
Route::get('/pas',[IftasController::class,'get_pas'])->name('pas.index')->middleware('auth');
Route::post('/pas',[IftasController::class,'pas'])->name('pas.submit')->middleware('auth');
Route::get('/pas/imp',[IftasController::class,'upload_pas'])->name('pas.upload')->middleware('auth');

Route::middleware('auth')->prefix('invoices')->group(function () {
    Route::get("/create", [FacturesController::class,'create'])->name('invoice.create');
    Route::get("/", [FacturesController::class,'index'])->name('invoices');
    Route::get("/{id}", [FacturesController::class,'edit'])->name('invoice.edit');
    Route::post("/delete", [FacturesController::class,'delete'])->name('invoice.delete');
    Route::post("/", [FacturesController::class,'store'])->name('invoice.store');
    Route::put("/", [FacturesController::class,'update'])->name('invoice.update');
    Route::get("/paycheck/weekly", [FacturesController::class,'paycheck'])->name('invoice.weekly');
});
Route::middleware('auth')->prefix('fuel')->group(function () {
    Route::get("/create", [FuelController::class,"create"])->name('fuel.create');
    Route::get("/", [FuelController::class,"index"])->name('fuel');
    Route::post("/", [FuelController::class,"store"])->name('fuel.store');
});

Route::post('import', [TransactionController::class,"import"])->name('import')->middleware('auth');
Route::get('/export/{id}',[TransactionController::class,'download'])->name('export')->middleware('auth');




Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
