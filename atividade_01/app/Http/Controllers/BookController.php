<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Book;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()    {
        $books = Book::all();
        return view('books.index', compact('books'));
    }
    



public function create()
    {
        return view('books.create');
    }

public function store(Request $request)
    {   
        // dd($request->all());
        Book::create($request->all());
        return redirect()->route('books.index');
    }
    
    
    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }
    
    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }
    
    public function update(Request $request, book $book)
    {   
        $book->update($request->all());

        return redirect()->route('books.index');
    }
    
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index');
    }
}