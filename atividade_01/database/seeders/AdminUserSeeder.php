<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            // Verifica se já existe um admin
        $existingAdmin = \App\Models\User::where('email', 'admin@biblioteca.com')->first();
        
        if (!$existingAdmin) {
            \App\Models\User::create([
                'name' => 'Administrador',
                'email' => 'admin@biblioteca.com',
                'password' => bcrypt('admin123'),
                'role' => 'admin'
            ]);
            
            $this->command->info('Usuário admin criado com sucesso!');
        } else {
            // Se já existe, apenas atualiza o papel
            $existingAdmin->update(['role' => 'admin']);
            $this->command->info('Usuário admin atualizado para papel de admin!');
        }
    }
}
