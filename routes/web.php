<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KartuKeluargaController;
use App\Http\Controllers\KtpController; 
use App\Http\Controllers\KkItemController;
use Illuminate\Support\Facades\Route;

   
Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'index'])->name('login'); 
    Route::post('/process', [AuthController::class, 'process'])->name('auth');
});
Route::middleware('auth')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::resource('ktp', KtpController::class);
    Route::resource('kk', KartuKeluargaController::class);
    Route::resource('kkitem', KkItemController::class);
    Route::get('/kkitem/item/{idkk}', [KkItemController::class, 'index'])->name('kkitem.item');
    Route::get('/kkitem/create/{idkk}', [KkItemController::class, 'create'])->name('kkitem.create.get');  
    Route::post('/kkitem/store/{idkk}', [KkItemController::class, 'store'])->name('kkitem.store.post');
});