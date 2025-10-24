<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;

class AuthorController extends Controller
{
    // Exibe uma lista de categorias
    public function index()
    {
        $authors = Author::all();
        return view('authors.index', compact('authors'));
    }

    // Mostra o formulário para criar uma nova categoria
    public function create()
    {
        return view('authors.create');
    }

    // Armazena uma nova categoria no banco de dados
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:authors|max:255',
        ]);

        Author::create($request->all());

        return redirect()->route('authors.index')->with('success', 'Author criado com sucesso.');
    }

    // Exibe uma categoria específica
    public function show(Author $author)
    {
        return view('authors.show', compact('author'));
    }

    // Mostra o formulário para editar uma categoria existente
    public function edit(Author $author)
    {
        return view('authors.edit', compact('author'));
    }

    // Atualiza uma categoria no banco de dados
    public function update(Request $request, Author $author)
    {
        $request->validate([
            'name' => 'required|string|unique:authors,name,' . $author->id . '|max:255',
        ]);

        $Author->update($request->all());

        return redirect()->route('authors.index')->with('success', 'author atualizado com sucesso.');
    }

    // Remove uma categoria do banco de dados
    public function destroy(Author $author)
    {
        $Author->delete();

        return redirect()->route('authors.index')->with('success', 'author excluído com sucesso.');
    }
}
