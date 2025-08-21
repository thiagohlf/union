<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site\FileController;

// Rota que exibe o formulário de upload
Route::get('/', [FileController::class, 'showUploadForm'])->name('upload.form');

// Rota que processa o upload e unifica os arquivos
Route::post('/merge', [FileController::class, 'mergeFiles'])->name('merge');

// Rota para fazer o download do arquivo unificado
Route::get('/download', [FileController::class, 'downloadMergedFile'])->name('download');
