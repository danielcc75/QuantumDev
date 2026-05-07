<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\TecnologiasSeeder;
use Database\Seeders\HabilidadesBlandasSeeder;
use Database\Seeders\AdminSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(TecnologiasSeeder::class);
        $this->call(HabilidadesBlandasSeeder::class);
        $this->call(AdminSeeder::class);
    }
}
