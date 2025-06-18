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
        $proveedores = [
            ['nombre' => 'Ana Morales', 'empresa' => 'Morales Textiles', 'contacto' => 'ana.morales@textiles.com', 'productos' => 'Ropa, Telas, Zapatos', 'clasificacion' => 'Mayorista', 'activo' => true],
            ['nombre' => 'Carlos Ruiz', 'empresa' => 'Ferretería Ruiz', 'contacto' => 'carlos.ruiz@ferre.com', 'productos' => 'Herramientas, Tornillos, Cemento', 'clasificacion' => 'Minorista', 'activo' => true],
            ['nombre' => 'Sofía López', 'empresa' => 'López Suministros', 'contacto' => 'sofia.lopez@suministros.com', 'productos' => 'Papelería, Útiles escolares, Libretas', 'clasificacion' => 'Mayorista', 'activo' => true],
            ['nombre' => 'Javier Ortega', 'empresa' => 'Ortega Muebles', 'contacto' => 'j.ortega@muebles.com', 'productos' => 'Mesas, Sillas, Cortinas', 'clasificacion' => 'Minorista', 'activo' => false],
            ['nombre' => 'María Herrera', 'empresa' => 'Distribuidora Herrera', 'contacto' => 'm.herrera@distribuidora.com', 'productos' => 'Arroz, Frijol, Maíz', 'clasificacion' => 'Mayorista', 'activo' => true],
            ['nombre' => 'Luis Torres', 'empresa' => 'Torres Eléctricos', 'contacto' => 'l.torres@electricos.com', 'productos' => 'Cableado, Enchufes, Lámparas', 'clasificacion' => 'Minorista', 'activo' => true],
            ['nombre' => 'Andrea Gómez', 'empresa' => 'Gómez Cosméticos', 'contacto' => 'andrea.gomez@cosmeticos.com', 'productos' => 'Maquillaje, Cremas, Perfumes', 'clasificacion' => 'Mayorista', 'activo' => false],
            ['nombre' => 'Pedro Mendoza', 'empresa' => 'Mendoza Computación', 'contacto' => 'p.mendoza@pc.com', 'productos' => 'Computadoras, Celulares, Tablets', 'clasificacion' => 'Minorista', 'activo' => true],
            ['nombre' => 'Claudia Rivas', 'empresa' => 'Rivas Joyería', 'contacto' => 'claudia@joyeria.com', 'productos' => 'Anillos, Collares, Pulseras', 'clasificacion' => 'Mayorista', 'activo' => true],
            ['nombre' => 'Raúl Sánchez', 'empresa' => 'Sánchez Granos', 'contacto' => 'raul.sanchez@granos.com', 'productos' => 'Arroz, Frijol, Lentejas', 'clasificacion' => 'Minorista', 'activo' => true],
            ['nombre' => 'Isabel Cañas', 'empresa' => 'Cañas Farmacia', 'contacto' => 'isabel@farmacia.com', 'productos' => 'Medicamentos, Vitaminas, Suplementos', 'clasificacion' => 'Mayorista', 'activo' => true],
            ['nombre' => 'David Martínez', 'empresa' => 'Martínez Construcciones', 'contacto' => 'david@construcciones.com', 'productos' => 'Cemento, Arena, Ladrillos', 'clasificacion' => 'Minorista', 'activo' => false],
            ['nombre' => 'Gabriela Campos', 'empresa' => 'Campos Bebidas', 'contacto' => 'g.campos@bebidas.com', 'productos' => 'Jugos, Gaseosas, Agua', 'clasificacion' => 'Mayorista', 'activo' => true],
            ['nombre' => 'Fernando Álvarez', 'empresa' => 'Álvarez Calzado', 'contacto' => 'fernando@calzado.com', 'productos' => 'Zapatos, Botas, Sandalias', 'clasificacion' => 'Minorista', 'activo' => true],
            ['nombre' => 'Lucía Delgado', 'empresa' => 'Delgado Decoración', 'contacto' => 'lucia@decoracion.com', 'productos' => 'Cuadros, Cortinas, Alfombras', 'clasificacion' => 'Mayorista', 'activo' => true],
            ['nombre' => 'José Molina', 'empresa' => 'Molina Autos', 'contacto' => 'jose@autos.com', 'productos' => 'Repuestos, Aceites, Filtros', 'clasificacion' => 'Minorista', 'activo' => true],
            ['nombre' => 'Verónica Salinas', 'empresa' => 'Salinas Alimentos', 'contacto' => 'veronica@alimentos.com', 'productos' => 'Cereales, Galletas, Arroz', 'clasificacion' => 'Mayorista', 'activo' => false],
            ['nombre' => 'Héctor Funes', 'empresa' => 'Funes Tecnología', 'contacto' => 'hector@tecnologia.com', 'productos' => 'Celulares, Audífonos, Tablets', 'clasificacion' => 'Minorista', 'activo' => true],
            ['nombre' => 'Nancy Guardado', 'empresa' => 'Guardado Hogar', 'contacto' => 'nancy@hogar.com', 'productos' => 'Cocinas, Refrigeradoras, Microondas', 'clasificacion' => 'Mayorista', 'activo' => true],
            ['nombre' => 'Óscar Lemus', 'empresa' => 'Lemus Agro', 'contacto' => 'oscar@agro.com', 'productos' => 'Abono, Semillas, Herramientas', 'clasificacion' => 'Minorista', 'activo' => true],
        ];

        foreach ($proveedores as $prov) {
            Proveedor::create($prov);
        }
    }
}
