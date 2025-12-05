<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', User::class);
        $users = \App\Models\User::paginate(10); // Paginação para 10 usuários por página
        return view('users.index', compact('users'));
    }

    public function show(\App\Models\User $user)
    {
        $this->authorize('viewAny', User::class);
        $user->load(['borrowings' => function($query) {
            $query->with('book')->latest();
    }]);
        return view('users.show', compact('user'));
    }

    public function edit(\App\Models\User $user)
    {
        $this->authorize('viewAny', User::class);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, \App\Models\User $user)
    {
        $this->authorize('viewAny', User::class);

         $rules = [
            'name' => 'required|string|max:255',
        ];

        if (auth()->user()->role === 'admin') {
            $rules['role'] = 'required|in:admin,bibliotecario,cliente';
        }

        $request->validate($rules);
    
        $user->update($request->all());

        return redirect()->route('users.index')->with('success', 'Usuário atualizado com sucesso.');
    }


    public function destroy(User $user)
    {
        // Autorizar usando a Policy
        $this->authorize('delete', $user);
        
        // Verifica se está tentando deletar a si mesmo
        if ($user->id === auth()->id()) {
            return redirect()->route('users.index')
                ->with('error', 'Você não pode deletar sua própria conta!');
        }
        
        // Deleta o usuário
        $userName = $user->name;
        $user->delete();
        
        return redirect()->route('users.index')
            ->with('success', "Usuário '{$userName}' deletado com sucesso!");
    }
}

