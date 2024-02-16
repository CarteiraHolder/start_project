<?php

use App\Models\User;
use App\Notifications\RegisterUserNotify;
use Illuminate\Support\Facades\Route;

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

// NO AUTH
Route::get('/', fn () =>  view('app'))->name('login');
Route::get('/nova-senha/{hash}', fn () =>  view('app'))->name('nova-senha@vue');
Route::get('/esqueci-minha-senha', fn () =>  view('app'))->name('esqueci-minha-senha@vue');
Route::get('/cadastre-se', fn () =>  view('app'))->name('cadastre-se@vue');
// NO AUTH

Route::get('/dashboard', fn () => view('app'))->name('dashboard@vue');

Route::prefix('usuario')->group(
    function () {
        Route::get('/dashboard', fn () => view('app'))->name('usuario/dashboard@vue');
        Route::get('/listar', fn () => view('app'))->name('usuario/listar@vue');
        Route::get('/cadastrar', fn () => view('app'))->name('usuario/cadastrar@vue');
        Route::get('/atualizar/{id}', fn () => view('app'))->name('usuario/atualizar@vue');
    }
);

Route::prefix('perfil')->group(
    function () {
        Route::get('/meu-cadastro', fn () => view('app'))->name('meu-cadastro@vue');
        Route::get('/trocar-senha', fn () => view('app'))->name('trocar-senha@vue');
    }
);

Route::prefix('configuracoes')->group(
    function () {
        Route::get('/dashboard', fn () => view('app'))->name('configuracoes/dashboard@vue');
        Route::get('/editar', fn () => view('app'))->name('configuracoes/atualizar@vue');
    }
);
