<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Usuario;
use App\Models\Perfil;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $admin = Usuario::updateOrCreate(
            ['correo_electronico' => 'admin@quantumdev.com'],
            [
                'nombre' => 'Administrador',
                'apellido' => 'Sistema',
                'telefono' => null,
                'contrasenia' => Hash::make('Admin123!'),
                'estado' => 'activo',
                'is_admin' => true
            ]
        );
        
        Perfil::firstOrCreate(
            ['id_usuario' => $admin->id_usuario],
            ['visible' => true]
        );
        
        $this->command->info('Administrador creado: admin@quantumdev.com / Admin123!');
    }
}