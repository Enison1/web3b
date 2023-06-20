<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\AutorController;
use App\Http\Controllers\LivroController;
use App\Http\Controllers\ExemplarController;
use App\Http\Controllers\AlunoController;
use App\Http\Controllers\EmprestimoController;
use App\Http\Controllers\LibController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/categoria/listar', [CategoriaController::class, 'listar']);
    Route::get('/categoria/novo', [CategoriaController::class, 'novo']);
    Route::get('/categoria/editar/{id}', [CategoriaController::class, 'editar']);
    Route::get('/categoria/excluir/{id}', [CategoriaController::class, 'excluir']);
    Route::post('/categoria/salvar', [CategoriaController::class, 'salvar']);
    Route::get('/categoria/relatorio', [CategoriaController::class, 'relatorio']);
    
    Route::get('/exemplar/listar', [ExemplarController::class, 'listar']);
    Route::get('/exemplar/novo', [ExemplarController::class, 'novo']);
    Route::get('/exemplar/editar/{id}', [ExemplarController::class, 'editar']);
    Route::get('/exemplar/excluir/{id}', [ExemplarController::class, 'excluir']);
    Route::post('/exemplar/salvar', [ExemplarController::class, 'salvar']);
    Route::get('/exemplar/relatorio', [ExemplarController::class, 'relatorio']);

    Route::get('/autor/listar', [AutorController::class, 'listar']);
    Route::get('/autor/novo', [AutorController::class, 'novo']);
    Route::get('/autor/editar/{id}', [AutorController::class, 'editar']);
    Route::get('/autor/excluir/{id}', [AutorController::class, 'excluir']);
    Route::get('/autor/mensagem/{id}', [AutorController::class, 'mensagem']);
    Route::post('/autor/salvar', [AutorController::class, 'salvar']);
    Route::post('/autor/mensagem', [AutorController::class, 'enviarMensagem']);

    Route::get('/aluno/listar', [AlunoController::class, 'listar']);
    Route::get('/aluno/novo', [AlunoController::class, 'novo']);
    Route::get('/aluno/editar/{id}', [AlunoController::class, 'editar']);
    Route::get('/aluno/excluir/{id}', [AlunoController::class, 'excluir']);
    Route::get('/aluno/mensagem/{id}', [AlunoController::class, 'mensagem']);
    Route::post('/aluno/salvar', [AlunoController::class, 'salvar']);
    Route::post('/aluno/mensagem', [AlunoController::class, 'enviarMensagem']);

    Route::get('/livro/listar', [LivroController::class, 'listar']);
    Route::get('/livro/novo', [LivroController::class, 'novo']);
    Route::get('/livro/editar/{id}', [LivroController::class, 'editar']);
    Route::get('/livro/excluir/{id}', [LivroController::class, 'excluir']);
    Route::post('/livro/salvar', [LivroController::class, 'salvar']);

    Route::get('/emprestimo/listar', [EmprestimoController::class, 'listar']);
    Route::get('/emprestimo/novo', [EmprestimoController::class, 'novo']);
    Route::get('/emprestimo/editar/{id}', [EmprestimoController::class, 'editar']);
    Route::get('/emprestimo/excluir/{id}', [EmprestimoController::class, 'excluir']);
    Route::post('/emprestimo/salvar', [EmprestimoController::class, 'salvar']);

    Route::get('/', function () {
        return view('index');
    });
});

Route::get('/lib', [LibController::class, 'index']);
Route::get('/lib/livro/{id}', [LibController::class, 'livro']);
Route::get('/lib/categoria/{id}', [LibController::class, 'categoria']);
Route::get('/lib/livro/{id}', [LibController::class, 'emprestimo']);
Route::get('/lib/categoria/{id}', [LibController::class, 'exemplar']);

require __DIR__.'/auth.php';
