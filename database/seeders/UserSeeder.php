<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $user = User::create([
            'name' => 'Prueba',
            'email' => 'correo@correo.com',
            'password' => Hash::make('Abc123456!')
        ]);

        $user2 = User::create([
            'name' => 'Gian',
            'email' => 'gian@gian.com',
            'password' => Hash::make('Abc123456!')
        ]);

        $role = Role::create(['name' => 'admin']);

        $user->assignRole($role);

    }
}
