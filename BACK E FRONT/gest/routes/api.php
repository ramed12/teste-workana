<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [\App\Http\Controllers\Api\authController::class, 'login'])->name('login');

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/logout', [\App\Http\Controllers\Api\authController::class, 'logout'])->name('logout');

    Route::get('/usuarios', [\App\Http\Controllers\Api\userController::class, 'index'])->name('users');
    Route::post('/usuario/criar', [\App\Http\Controllers\Api\userController::class, 'store'])->name('user-store');
    Route::get('/usuario/editar/{id}', [\App\Http\Controllers\Api\userController::class, 'show'])->name('user-show');
    Route::put('/usuario/editar/{id}', [\App\Http\Controllers\Api\userController::class, 'update'])->name('user-update');
    Route::delete('/usuario/apagar/{id}', [\App\Http\Controllers\Api\userController::class, 'delete'])->name('user-delete');

    Route::get('/autores', [\App\Http\Controllers\Api\authorController::class, 'index'])->name('authors');
    Route::post('/autor/criar', [\App\Http\Controllers\Api\authorController::class, 'store'])->name('author-store');
    Route::get('/autor/editar/{id}', [\App\Http\Controllers\Api\authorController::class, 'show'])->name('author-show');
    Route::put('/autor/editar/{id}', [\App\Http\Controllers\Api\authorController::class, 'update'])->name('author-update');
    Route::delete('/autor/apagar/{id}', [\App\Http\Controllers\Api\authorController::class, 'delete'])->name('author-delete');

    Route::get('/livros', [\App\Http\Controllers\Api\bookController::class, 'index'])->name('books');
    Route::post('/livro/criar', [\App\Http\Controllers\Api\bookController::class, 'store'])->name('book-store');
    Route::get('/livro/editar/{id}', [\App\Http\Controllers\Api\bookController::class, 'show'])->name('book-show');
    Route::put('/livro/editar/{id}', [\App\Http\Controllers\Api\bookController::class, 'update'])->name('book-update');
    Route::delete('/livro/apagar/{id}', [\App\Http\Controllers\Api\bookController::class, 'delete'])->name('book-delete');
});
