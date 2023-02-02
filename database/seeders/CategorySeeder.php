<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $categories = [[
            'name' => 'Café',
            'iconName' => 'cafe',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ], [
            'name' => 'Hamburguesas',
            'iconName' => 'hamburguesa',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ], [
            'name' => 'Pizzas',
            'iconName' => 'pizza',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ], [
            'name' => 'Donas',
            'iconName' => 'dona',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ], [
            'name' => 'Pasteles',
            'iconName' => 'pastel',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ], [
            'name' => 'Galletas',
            'iconName' => 'galletas',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]];

        DB::table('categories')->insert($categories);

    }
}
