<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Categoria;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $categoria = Categoria::find(1);

        if($categoria == null){

            Categoria::create([
                'titulo' => 'LIVRE',
                'cor' => "Azul"
            ]);
        }
    }
}
