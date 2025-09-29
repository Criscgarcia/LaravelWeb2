<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Carro;

class CarroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()    {
        $carros = Carro::all();
        return view('carros.index', compact('carros'));
    }
    



public function create()
    {
        return view('carros.create');
    }

public function store(Request $request)
    {   
        // dd($request->all());
        Carro::create($request->all());
        return redirect()->route('carros.index');
    }
    
    
    public function show(Carro $carro)
    {
        return view('carros.show', compact('carro'));
    }
    
    public function edit(Carro $carro)
    {
        return view('carros.edit', compact('carro'));
    }
    
    public function update(Request $request, carro $carro)
    {   
        $carro->update($request->all());

        return redirect()->route('carros.index');
    }
    
    public function destroy(Carro $carro)
    {
        $carro->delete();
        return redirect()->route('carros.index');
    }
}