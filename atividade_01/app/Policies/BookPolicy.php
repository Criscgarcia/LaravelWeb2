<?php

namespace App\Policies;

use App\Models\Book;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BookPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    // app/Policies/BookPolicy.php
    public function viewAny(User $user)
    {
        return true; // Todos podem visualizar livros
    }

    public function view(User $user, Book $book)
    {
        return true; // Todos podem ver detalhes
    }

    public function create(User $user)
    {
        return in_array($user->role, ['admin', 'bibliotecario']);
    }

    public function update(User $user, Book $book)
    {
        return in_array($user->role, ['admin', 'bibliotecario']);
    }

    public function delete(User $user, Book $book)
    {
        return $user->role === 'admin';
    }

    public function restore(User $user, Book $book)
    {
        return $user->role === 'admin';
    }

    public function forceDelete(User $user, Book $book)
    {
        return $user->role === 'admin';
    }
}
