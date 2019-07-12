<?php

use App\Models\Config;
use Illuminate\Database\Seeder;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $config = [
            'nombre' => 'iva',
            'clave' => 'iva',
            'valor' => '22',
            'created_at' => now(),
            'updated_at' => now(),
        ];

        Config::insert($config);
    }

}
