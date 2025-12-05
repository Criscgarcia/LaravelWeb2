<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    // app/Policies/UserPolicy.php
    public function viewAny(User $user)
    {
        return $user->role === 'admin';
    }

    public function view(User $user, User $model)
    {
        // Admin vê todos, usuário comum só vê próprio perfil
        return $user->role === 'admin' || $user->id === $model->id;
    }

    public function update(User $user, User $model)
    {
        // Admin pode editar qualquer usuário, incluindo papel
        if ($user->role === 'admin') {
            return true;
        }
        
        // Usuário comum só pode editar próprio perfil (sem mudar papel)
        return $user->id === $model->id;
    }

    public function delete(User $user, User $model)
    {
        return $user->role === 'admin';
    }

    public function changeRole(User $user, User $model)
    {
        // Apenas admin pode mudar papel de outros usuários
        return $user->role === 'admin';
    }
}
