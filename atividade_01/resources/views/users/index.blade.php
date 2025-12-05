@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Lista de Usuários</h1>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Papel</th>
                <th>Data de Cadastro</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
             @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>
                    <strong>{{ $user->name }}</strong><br>
                    <small class="text-muted">{{ $user->email }}</small>
                </td>
                <td>
                    <span class="badge 
                        @if($user->role === 'admin') bg-danger
                        @elseif($user->role === 'bibliotecario') bg-warning text-dark
                        @else bg-info @endif">
                        {{ $user->role }}
                    </span>
                </td>
                <td>
                    {{ $user->created_at->format('d/m/Y') }}
                </td>
                <td>
                     <!-- Botão Visualizar -->
                    <a href="{{ route('users.show', $user) }}" class="btn btn-info btn-sm">
                        <i class="bi bi-eye"></i> Visualizar
                    </a>

                    <!-- Botão Editar -->
                    <a href="{{ route('users.edit', $user) }}" class="btn btn-primary btn-sm">
                        <i class="bi bi-pencil"></i> Editar
                    </a>
                    
                    <!-- Botão Deletar (SÓ ADMIN e NÃO pode deletar a si mesmo) -->
                    @if(auth()->user()->role === 'admin' && $user->id !== auth()->id())
                        <button type="button" class="btn btn-danger btn-sm" 
                                data-bs-toggle="modal" data-bs-target="#deleteModal{{ $user->id }}">
                            <i class="bi bi-trash"></i> Deletar
                        </button>
                        
                        <!-- Modal de Confirmação -->
                        <div class="modal fade" id="deleteModal{{ $user->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Confirmar Exclusão</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Tem certeza que deseja deletar o usuário <strong>{{ $user->name }}</strong>?</p>
                                        <p class="text-danger">
                                            <i class="bi bi-exclamation-triangle"></i> 
                                            Esta ação não pode ser desfeita!
                                        </p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <form action="{{ route('users.destroy', $user) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Deletar Usuário</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {{ $users->links() }}
    </div>
</div>
@endsection

