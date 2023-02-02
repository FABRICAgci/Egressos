<?php

use App\Http\Controllers\AreaController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\RelatorioController;
use App\Http\Controllers\TituloController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserEgressoAdminController;

Route::prefix('admin')->middleware(['auth'])->group(function(){
    
    Route::any('egresso/listar', [UserEgressoAdminController::class, 'index'])->name('index-egresso-admin');
    Route::get('egresso/inserir', [UserEgressoAdminController::class, 'create'])->name('create-egresso-admin');
    Route::post('egresso/inserir', [UserEgressoAdminController::class, 'store'])->name('store-egresso-admin');
    Route::get('egresso/editar/{id}', [UserEgressoAdminController::class, 'edit'])->name('edit-egresso-admin');
    Route::post('egresso/editar/{id}', [UserEgressoAdminController::class, 'update'])->name('update-egresso-admin');
    Route::get('egresso/apagar/{id}', [UserEgressoAdminController::class, 'destroy'])->name('destroy-egresso-admin');
    Route::get('cidade/{uf}', [UserEgressoAdminController::class, 'cidades'])->name('cidades-egresso-admin');

    Route::any('usuario/listar', [UserController::class, 'index'])->name('index-administrador');
    Route::get('usuario/inserir', [UserController::class, 'create'])->name('create-administrador');
    Route::post('usuario/inserir', [UserController::class, 'store'])->name('store-administrador');
    Route::get('usuario/editar/{id}', [UserController::class, 'edit'])->name('edit-administrador');
    Route::post('usuario/editar/{id}', [UserController::class, 'update'])->name('update-administrador');
    Route::get('usuario/apagar/{id}', [UserController::class, 'destroy'])->name('destroy-administrador');

    Route::any('titulo/listar', [TituloController::class, 'index'])->name('index-titulo');
    Route::get('titulo/inserir', [TituloController::class, 'create'])->name('create-titulo');
    Route::post('titulo/inserir', [TituloController::class, 'store'])->name('store-titulo');
    Route::get('titulo/editar/{id}', [TituloController::class, 'edit'])->name('edit-titulo');
    Route::post('titulo/editar/{id}', [TituloController::class, 'update'])->name('update-titulo');
    Route::get('titulo/apagar/{id}', [TituloController::class, 'destroy'])->name('destroy-titulo');

    Route::any('area/listar', [AreaController::class, 'index'])->name('index-area');
    Route::get('area/inserir', [AreaController::class, 'create'])->name('create-area');
    Route::post('area/inserir', [AreaController::class, 'store'])->name('store-area');
    Route::get('area/editar/{id}', [AreaController::class, 'edit'])->name('edit-area');
    Route::post('area/editar/{id}', [AreaController::class, 'update'])->name('update-area');
    Route::get('area/apagar/{id}', [AreaController::class, 'destroy'])->name('destroy-area');

    Route::any('relatorio/egresso/', [RelatorioController::class, 'rel_egresso'])->name('rel-egresso');
    Route::any('relatorio/titulo', [RelatorioController::class, 'rel_titulo'])->name('rel-titulo');
    Route::any('relatorio/area', [RelatorioController::class, 'rel_area'])->name('rel-area');
    Route::any('relatorio/cidade', [RelatorioController::class, 'rel_cidade'])->name('rel-cidade');
    Route::any('relatorio/ano-formatura', [RelatorioController::class, 'ano_formatura'])->name('rel-ano-formatura');

    Route::any('relatorio/egresso/pdf', [PdfController::class, 'egresso'])->name('pdf-egresso');
    Route::any('relatorio/titulo/pdf', [PdfController::class, 'titulo'])->name('pdf-titulo');
    Route::any('relatorio/area/pdf', [PdfController::class, 'area'])->name('pdf-area');
    Route::any('relatorio/cidade/pdf', [PdfController::class, 'cidade'])->name('pdf-cidade');
    Route::any('relatorio/formatura/pdf', [PdfController::class, 'formatura'])->name('pdf-formatura');

});