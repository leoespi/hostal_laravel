<?php

namespace Database\Seeders;
use App\Models\User;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class AdminSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */

     public function run()
     {

     

        $user = User::create([
            'name' => "Administrador1",
            'cedula' => "1097092539",  // Agrega cedula 
            'email' => "talentohumanomxm1@gmail.com",
            'password' => Hash::make('123456'),
            'p_venta' => "ADMINISTRACION",
            'cargo'=> "ANALISTA DE PROCESOS",
            'rol_id' => 1,
            'is_active' => true,

        ]);

        
       
     }
}
