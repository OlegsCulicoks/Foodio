<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ReservationStepperController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/menu', [MenuController::class, 'index'])->name('menu');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/tables', [TableController::class, 'index'])->name('tables.index');

Route::prefix('reservations')->group(function () {
    Route::get('/', [ReservationStepperController::class, 'showStep1'])->name('reservations.create');
    Route::post('/step1', [ReservationStepperController::class, 'postStep1'])->name('reservations.postStep1');
    Route::get('/step2', [ReservationStepperController::class, 'showStep2'])->name('reservations.step2');
    Route::post('/step2', [ReservationStepperController::class, 'postStep2'])->name('reservations.postStep2');
    Route::get('/step3', [ReservationStepperController::class, 'showStep3'])->name('reservations.step3');
    Route::post('/step3', [ReservationStepperController::class, 'postStep3'])->name('reservations.postStep3');
    Route::get('/step4', [ReservationStepperController::class, 'showStep4'])->name('reservations.step4');
    Route::post('/store', [ReservationStepperController::class, 'store'])->name('reservations.store');
    Route::get('/confirmation', [ReservationStepperController::class, 'showConfirmation'])->name('reservations.confirmation');
});

Route::post('/send-email', [EmailController::class, 'send'])->name('send.email');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';

