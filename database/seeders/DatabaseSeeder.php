<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Categoria;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = User::find(1);

        if ($user == null) {

            User::create([
                'name' => "Administrador",
                'email' => "email@email.com",
                'password' => Hash::make("admin"),
                'api_token' => hash('sha256', "KWeLeFatUzFVif1NOWgDeEDinxvvfAKUOyUvCzzhMh2r8B6NPrzK5BUV6A685AEkFw3KC5lQAd0xRoXH")
            ]);
        }

        $categoria = Categoria::find(1);

        if ($categoria == null) {

            Categoria::create([
                'titulo' => 'LIVRE',
                'cor' => "Azul"
            ]);
        }
    }
}
