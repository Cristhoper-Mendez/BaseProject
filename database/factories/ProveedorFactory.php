<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Proveedor>
 */
class ProveedorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->name(),
            'empresa' => $this->faker->company(),
            'contacto' => $this->faker->phoneNumber(),
            'productos' => $this->faker->randomElement([
                'Zapatos, Camisas',
                'Computadoras, Accesorios',
                'Frutas, Verduras',
                'Libros, Cuadernos',
                'Muebles, Decoración'
            ]),
            'clasificacion' => $this->faker->randomElement([
                'Mayorista',
                'Distribuidor',
                'Minorista',
                'Importador'
            ]),
        ];
    }
}
