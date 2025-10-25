<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Publisher;

class PublisherController extends Controller
{
    // Exibe uma lista de categorias
    public function index()
    {
        $publishers = Publisher::all();
        return view('publishers.index', compact('publishers'));
    }

    // Mostra o formulário para criar uma nova categoria
    public function create()
    {
        return view('publishers.create');
    }

    // Armazena uma nova categoria no banco de dados
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:publishers|max:255',
        ]);

        Publisher::create($request->all());

        return redirect()->route('publishers.index')->with('success', 'Publisher criada com sucesso.');
    }

    // Exibe uma categoria específica
    public function show(Publisher $publisher)
    {
        return view('publishers.show', compact('publisher'));
    }

    // Mostra o formulário para editar uma categoria existente
    public function edit(Publisher $publisher)
    {
        return view('publishers.edit', compact('publisher'));
    }

    // Atualiza uma categoria no banco de dados
    public function update(Request $request, Publisher $publisher)
    {
        $request->validate([
            'name' => 'required|string|unique:publishers,name,' . $publisher->id . '|max:255',
        ]);

        $publisher->update($request->all());

        return redirect()->route('publishers.index')->with('success', 'Publisher atualizada com sucesso.');
    }

    // Remove uma categoria do banco de dados
    public function destroy(Publisher $publisher)
    {
        if ($publisher->books()->exists()) {
            return redirect()->route('publishers.index')
                ->with('error', 'Não é possível excluir esta editora porque existem livros vinculados a ela.');
        }

        $publisher->delete();

        return redirect()->route('publishers.index')->with('success', 'Publisher excluída com sucesso.');
    }
}

