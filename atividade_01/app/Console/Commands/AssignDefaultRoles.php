<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class AssignDefaultRoles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:assign-roles';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Atribui papel padrão "cliente" a todos os usuários sem papel definido';

   
    // app/Console/Commands/AssignDefaultRoles.php
    public function handle()
    {
        // Atribui 'cliente' para todos os usuários sem papel
        \App\Models\User::whereNull('role')->orWhere('role', '')->update(['role' => 'cliente']);
        
        $this->info('Papéis padrão atribuídos com sucesso!');
    }
}
