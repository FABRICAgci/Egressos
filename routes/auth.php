<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserEgressoController;

Route::namespace('Auth')->group(function () {
    Route::get('login', [LoginController::class, 'show_login_form'])->name('login');
    Route::post('login', [LoginController::class, 'process_login'])->name('login');
    Route::any('logout/{message?}', [LoginController::class, 'logout'])->name('logout');

    Route::get('registro', [UserEgressoController::class, 'create'])->name('create-registro');
    Route::post('registro', [UserEgressoController::class, 'store'])->name('store-registro');

    Route::get('cidade/{uf}', [UserEgressoController::class, 'cidades'])->name('cidades-registro');
});