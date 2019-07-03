<?php

use App\Models\Local;
use Illuminate\Database\Seeder;

class LocalesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $locales = [
        	[
	            'nombre' => 'Local 1',
	            'direccion' => 'Direccion 1',
	            'telefono_contacto' => '876363763',
                'logo_url' => '',
                'created_at' => now(),
	            'updated_at' => now()
			],
        	[
	            'nombre' => 'Local 2',
	            'direccion' => 'Direccion 2',
	            'telefono_contacto' => '2543543',
                'logo_url' => '',
                'created_at' => now(),
	            'updated_at' => now()
			],
        	[
	            'nombre' => 'Local 3',
	            'direccion' => 'Direccion 3',
	            'telefono_contacto' => '92883763',
                'logo_url' => '',
                'created_at' => now(),
	            'updated_at' => now()
			],
        ];
        
        Local::insert($locales);

    }
}
