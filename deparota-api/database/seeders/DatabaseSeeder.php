<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Crear Categorías
        $catComedores = Category::create(['name' => 'Comedores', 'slug' => Str::slug('Comedores')]);
        $catSalas = Category::create(['name' => 'Salas y Mesas de Centro', 'slug' => Str::slug('Salas y Mesas de Centro')]);
        $catRecamaras = Category::create(['name' => 'Recámaras', 'slug' => Str::slug('Recamaras')]);

        // 2. Crear Productos Premium (Con imágenes de Unsplash)
        Product::create([
            'category_id' => $catComedores->id,
            'name' => 'Comedor Parota Sólida 8 Sillas',
            'slug' => Str::slug('Comedor Parota Solida 8 Sillas'),
            'sku' => 'PAR-COM-001',
            'description' => 'Espectacular comedor fabricado en una sola pieza de madera de parota maciza. Incluye base metálica de diseño industrial en acabado negro mate y 8 sillas tapizadas en lino gris de alto tráfico.',
            'price' => 45000.00,
            'is_visible' => true,
            'image_url' => 'https://images.unsplash.com/photo-1577140917170-285929fb55b7?auto=format&fit=crop&q=80&w=1200',
            'dimensions' => '240cm x 110cm x 75cm',
        ]);

        Product::create([
            'category_id' => $catComedores->id,
            'name' => 'Mesa de Comedor Río de Resina',
            'slug' => Str::slug('Mesa de Comedor Rio de Resina'),
            'sku' => 'PAR-COM-002',
            'description' => 'Mesa de comedor de autor. Combina los bordes naturales de la madera de parota con un centro de resina epóxica cristalina. No incluye sillas.',
            'price' => 32500.00,
            'is_visible' => true,
            'image_url' => 'https://images.unsplash.com/photo-1604578762246-41134e37f9cc?auto=format&fit=crop&q=80&w=1200',
            'dimensions' => '200cm x 100cm x 75cm',
        ]);

        Product::create([
            'category_id' => $catSalas->id,
            'name' => 'Mesa de Centro Parota Rústica',
            'slug' => Str::slug('Mesa de Centro Parota Rustica'),
            'sku' => 'PAR-SAL-001',
            'description' => 'Mesa de centro con rodaja natural de parota. Respeta la forma orgánica del árbol, destacando las hermosas vetas bicolor (albura y duramen).',
            'price' => 8900.00,
            'is_visible' => true,
            'image_url' => 'https://images.unsplash.com/photo-1533090481720-856c6e3c1fdc?auto=format&fit=crop&q=80&w=1200',
            'dimensions' => '90cm diámetro promedio',
        ]);
    }
}