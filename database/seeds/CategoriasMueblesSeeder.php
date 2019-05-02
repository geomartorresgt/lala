<?php

use Illuminate\Database\Seeder;
use App\Models\CategoriaMueble;

class CategoriasMueblesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoriasMuebles = [
            [
                'nombre' => 'Anza',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Cerejeira Brillo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Cerejeira Mate',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Imbuia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'StyloNobre - Clásica',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'StyloNoble - Noble',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        CategoriaMueble::insert($categoriasMuebles);
    }
}
