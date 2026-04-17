<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeviceController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function(){

Route::get('/devices',[DeviceController::class,'index'])->name('devices');

Route::get('/scan',[DeviceController::class,'scan'])->name('scan');

Route::post('/find',[DeviceController::class,'find']);

Route::post('/masuk',[DeviceController::class,'masuk'])->name('masuk');

Route::post('/keluar',[DeviceController::class,'keluar'])->name('keluar');

});

require __DIR__.'/auth.php';
