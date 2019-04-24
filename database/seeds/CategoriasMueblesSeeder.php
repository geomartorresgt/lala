<?php

use Illuminate\Database\Seeder;

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
                'nombre' => 'primera',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Segunda',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Tercera',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Cuarta',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Quinta',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        App\Models\CategoriaMueble::insert($categoriasMuebles);
    }
}
