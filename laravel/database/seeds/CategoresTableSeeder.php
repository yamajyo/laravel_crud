<?php

use Illuminate\Database\Seeder;

class CategoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'category_name' => 'PHP'
        ];

        DB::table('categories')->insert($data);

        $data = [
            'category_name' => 'Laravel'
        ];

        DB::table('categories')->insert($data);

        $data = [
            'category_name' => 'javaScript'
        ];

        DB::table('categories')->insert($data);

        $data = [
            'category_name' => 'Vue.js'
        ];

        DB::table('categories')->insert($data);

        $data = [
            'category_name' => 'React'
        ];

        DB::table('categories')->insert($data);

    }
}
