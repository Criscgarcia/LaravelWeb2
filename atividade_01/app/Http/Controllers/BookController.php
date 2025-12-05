<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Book;
use App\Models\Publisher;
use App\Models\Author;
use App\Models\Category;
use App\Models\User; 

class BookController extends Controller
{
    // Formulário com input de ID
    public function createWithId()
    {
        $this->authorize('create', Book::class);
        return view('books.create-id');
    }

    // Salvar livro com input de ID
    public function storeWithId(Request $request)
    {
        $this->authorize('create', Book::class);
        $request->validate([
            'title' => 'required|string|max:255',
            'publisher_id' => 'required|exists:publishers,id',
            'author_id' => 'required|exists:authors,id',
            'category_id' => 'required|exists:categories,id',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('cover')) {
            $request->merge([
                'cover' => $request->file('cover')->store('books/covers', 'public')
            ]);
        }

        Book::create($request->all());

        return redirect()->route('books.index')->with('success', 'Livro criado com sucesso.');
    }

    // Formulário com input select
    public function createWithSelect()
    {
        $publishers = Publisher::all();
        $authors = Author::all();
        $categories = Category::all();

        $this->authorize('create', Book::class);
        return view('books.create-select', compact('publishers', 'authors', 'categories'));
    }

    // Salvar livro com input select
    public function storeWithSelect(Request $request)
    {
        $this->authorize('create', Book::class);
        $request->validate([
            'title' => 'required|string|max:255',
            'publisher_id' => 'required|exists:publishers,id',
            'author_id' => 'required|exists:authors,id',
            'category_id' => 'required|exists:categories,id',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('cover')) {
            $request->merge([
                'cover' => $request->file('cover')->store('books/covers', 'public')
            ]);
        }

        Book::create($request->all());

        return redirect()->route('books.index')->with('success', 'Livro criado com sucesso.');
    }

    public function edit(Book $book)
    {
        $this->authorize('update', $book);
        $publishers = Publisher::all();
        $authors = Author::all();
        $categories = Category::all();

    return view('books.edit', compact('book', 'publishers', 'authors', 'categories'));
    }

    public function update(Request $request, Book $book)
    {
        $this->authorize('update', $book);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'publisher_id' => 'required|exists:publishers,id',
            'author_id' => 'required|exists:authors,id',
            'category_id' => 'required|exists:categories,id',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Upload da nova imagem (se fornecida)
        if ($request->hasFile('cover')) {
            // Deletar imagem antiga
            $book->deleteCover();
            
            // Fazer upload da nova
            $validated['cover'] = $request->file('cover')->store('books/covers', 'public');
        }

        $book->update($validated);

        return redirect()->route('books.index')->with('success', 'Livro atualizado com sucesso.');
    }

    public function show(Book $book)
    {
        // Carregando autor, editora e categoria do livro com eager loading
        $book->load(['author', 'publisher', 'category']);

        // Carregar todos os usuários para o formulário de empréstimo
        $users = User::all();

        return view('books.show', compact('book','users'));
    }

    public function index()
    {
    // Carregar os livros com autores usando eager loading e paginação
    $books = Book::with('author')->paginate(20);

    return view('books.index', compact('books'));

    }
     
    public function destroy(Book $book)
    {
    $this->authorize('delete', $book);
    $book->delete();

    return redirect()->route('books.index')->with('success', 'Livro deletado com sucesso.');
    }




}
