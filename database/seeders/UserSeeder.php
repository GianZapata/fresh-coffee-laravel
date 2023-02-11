<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Gian',
                'email' => 'gian@gian.com',
                'password' => Hash::make('Abc123456!'),            
            ],
            [
                'name' => 'Prueba',
                'email' => 'correo@correo.com',
                'password' => Hash::make('Abc123456!'),            
            ],
        ];
        DB::table('users')->insert($users);
    }
}
