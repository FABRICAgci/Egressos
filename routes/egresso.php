<?php

use App\Http\Controllers\UserEgressoController;

Route::prefix('egresso')->middleware(['auth'])->group(function(){
    
    Route::any('listar', [UserEgressoController::class, 'index'])->name('index-egresso');
    Route::get('inserir', [UserEgressoController::class, 'create'])->name('create-egresso');
    Route::post('inserir', [UserEgressoController::class, 'store'])->name('store-egresso');
    Route::get('editar/{id}', [UserEgressoController::class, 'edit'])->name('edit-egresso');
    Route::post('editar/{id}', [UserEgressoController::class, 'update'])->name('update-egresso');
    Route::get('apagar/{id}', [UserEgressoController::class, 'destroy'])->name('destroy-egresso');
    Route::get('cidade/{uf}', [UserEgressoController::class, 'cidades'])->name('cidades-egresso');

});