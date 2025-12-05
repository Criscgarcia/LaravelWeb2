@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Editar Usuário: {{ $user->name }}</h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('users.update', $user) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">Nome</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name', $user->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                   id="email" name="email" value="{{ old('email', $user->email) }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- ========== CAMPO DE PAPEL (SÓ PARA ADMIN) ========== -->
                        @if(auth()->user()->role === 'admin')
                            <div class="mb-3">
                                <label for="role" class="form-label">Papel</label>
                                <select class="form-control @error('role') is-invalid @enderror" 
                                        id="role" name="role" required>
                                    <option value="cliente" {{ $user->role == 'cliente' ? 'selected' : '' }}>Cliente</option>
                                    <option value="bibliotecario" {{ $user->role == 'bibliotecario' ? 'selected' : '' }}>Bibliotecário</option>
                                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Administrador</option>
                                </select>
                                @error('role')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Apenas administradores podem alterar papéis.</small>
                            </div>
                        @else
                            <!-- Para não-admin, mostra o papel mas não permite editar -->
                            <div class="mb-3">
                                <label class="form-label">Papel</label>
                                <input type="text" class="form-control" value="{{ $user->role }}" disabled>
                                <input type="hidden" name="role" value="{{ $user->role }}">
                                <small class="text-muted">Você não tem permissão para alterar papéis.</small>
                            </div>
                        @endif
                        <!-- ========== FIM DO CAMPO DE PAPEL ========== -->

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('users.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i> Voltar
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle"></i> Atualizar Usuário
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection