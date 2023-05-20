<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('types')->insert([
            ['type_name' => '車'],
            ['type_name' => 'バイク'],
            ['type_name' => '自転車'],
        ]);
    }
}
