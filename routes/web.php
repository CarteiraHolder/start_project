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
// NO AUTH

Route::get('/dashboard', fn () => view('app'))->name('dashboard@vue');

Route::prefix('contratante')->group(
    function () {
        Route::get('/listar', fn () => view('app'))->name('contratante/listar@vue');
        Route::get('/cadastrar', fn () => view('app'))->name('contratante/cadastrar@vue');
        Route::get('/atualizar/{id}', fn () => view('app'))->name('contratante/atualizar@vue');
        Route::get('/dashboard', fn () => view('app'))->name('contratante/dashboard@vue');
    }
);

Route::prefix('usuario')->group(
    function () {
        Route::get('/dashboard', fn () => view('app'))->name('usuario/dashboard@vue');
        Route::get('/listar', fn () => view('app'))->name('usuario/listar@vue');
        Route::get('/cadastrar', fn () => view('app'))->name('usuario/cadastrar@vue');
        Route::get('/atualizar/{id}', fn () => view('app'))->name('usuario/atualizar@vue');
    }
);

Route::prefix('pdv')->group(
    function () {
        Route::get('/dashboard', fn () => view('app'))->name('pdv/dashboard@vue');
        Route::get('/listar', fn () => view('app'))->name('pdv/listar@vue');
        Route::get('/cadastrar', fn () => view('app'))->name('pdv/cadastrar@vue');
        Route::get('/atualizar/{id}', fn () => view('app'))->name('pdv/atualizar@vue');
    }
);

Route::prefix('sku')->group(
    function () {
        Route::get('/dashboard', fn () => view('app'))->name('pdv/dashboard@vue');
        Route::get('/listar', fn () => view('app'))->name('pdv/listar@vue');
        Route::get('/cadastrar', fn () => view('app'))->name('pdv/cadastrar@vue');
        Route::get('/atualizar/{id}', fn () => view('app'))->name('pdv/atualizar@vue');
    }
);

Route::prefix('importacao')->group(
    function () {
        Route::get('/', fn () => view('app'))->name('importacao/csv@vue');
        Route::get('/historico', fn () => view('app'))->name('importacao/listar@vue');
        Route::get('/historico/detalhado/{id}', fn () => view('app'))->name('importacao/listar/byId@vue');
    }
);

Route::prefix('agenda')->group(
    function () {
        Route::get('/dia', fn () => view('app'))->name('agenda/dia@vue');
        Route::get('/dia2', fn () => view('app'))->name('agenda/dia2@vue');
        Route::get('/semana', fn () => view('app'))->name('agenda/semana@vue');
        Route::get('/mes', fn () => view('app'))->name('agenda/mes@vue');
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
