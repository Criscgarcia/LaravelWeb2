<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\HomeController;

// Rota inicial pública
Route::get('/', [BookController::class, 'index'])->name('home');

// Resources públicos (todos podem ver)
Route::resource('categories', CategoryController::class)->only(['index', 'show']);
Route::resource('authors', AuthorController::class)->only(['index', 'show']);
Route::resource('publishers', PublisherController::class)->only(['index', 'show']);

Auth::routes();

Route::get('/home', [HomeController::class, 'index']);

// ======================
// ROTAS PROTEGIDAS POR PAPEL
// ======================

// ROTAS PARA BIBLIOTECÁRIO E ADMIN
Route::middleware(['auth', 'role:admin,bibliotecario'])->group(function () {
    
    // Criação de livros
    Route::get('/books/create-id-number', [BookController::class, 'createWithId'])->name('books.create.id');
    Route::post('/books/create-id-number', [BookController::class, 'storeWithId'])->name('books.store.id');
    
    Route::get('/books/create-select', [BookController::class, 'createWithSelect'])->name('books.create.select');
    Route::post('/books/create-select', [BookController::class, 'storeWithSelect'])->name('books.store.select');
    
    // Edição de categorias, autores, editoras
    Route::resource('categories', CategoryController::class)->except(['index', 'show', 'create', 'store']);
    Route::resource('authors', AuthorController::class)->except(['index', 'show', 'create', 'store']);
    Route::resource('publishers', PublisherController::class)->except(['index', 'show', 'create', 'store']);
    
    // Empréstimos
    Route::post('/books/{book}/borrow', [BorrowingController::class, 'store'])->name('books.borrow');
    Route::get('/users/{user}/borrowings', [BorrowingController::class, 'userBorrowings'])->name('users.borrowings');
    Route::patch('/borrowings/{borrowing}/return', [BorrowingController::class, 'returnBook'])->name('borrowings.return');
});

// ROTAS PARA TODOS OS USUÁRIOS LOGADOS
Route::middleware(['auth'])->group(function () {
    // Books (todos logados podem ver e editar seus próprios?)
    Route::resource('books', BookController::class)->except(['create', 'store']);
    
    // Users (cada um vê/edita apenas seu perfil)
    Route::resource('users', UserController::class)->except(['create', 'store', 'destroy', 'index']);
});

// ROTAS EXCLUSIVAS PARA ADMIN
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Admin pode ver todos os usuários
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    
    // Admin pode excluir livros
    Route::delete('/books/{book}', [BookController::class, 'destroy'])->name('books.destroy');
    
    // Admin pode excluir categorias, autores, editoras
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    Route::delete('/authors/{author}', [AuthorController::class, 'destroy'])->name('authors.destroy');
    Route::delete('/publishers/{publisher}', [PublisherController::class, 'destroy'])->name('publishers.destroy');
});