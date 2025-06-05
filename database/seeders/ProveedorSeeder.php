<?php

namespace Database\Seeders;

use App\Models\Proveedor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProveedorSeeder extends Seeder
{
    public function run(): void
    {
        Proveedor::create([
            'nombre' => 'Juan Pérez',
            'empresa' => 'Distribuciones Pérez S.A.',
            'contacto' => 'juan.perez@email.com',
            'productos' => 'Electrónicos, Electrodomésticos',
            'clasificacion' => 'Mayorista',
            'activo' => true
        ]);
    }
}
