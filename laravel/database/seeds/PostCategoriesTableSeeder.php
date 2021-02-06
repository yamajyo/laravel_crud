<?php

use Illuminate\Database\Seeder;

class PostCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'post_id' => '1',
            'category_id' => '1',
        ];

        DB::table('post_categories')->insert($data);

        $data = [
            'post_id' => '2',
            'category_id' => '1',
        ];

        DB::table('post_categories')->insert($data);

        $data = [
            'post_id' => '3',
            'category_id' => '2',
        ];

        DB::table('post_categories')->insert($data);

        $data = [
            'post_id' => '4',
            'category_id' => '4',
        ];

        DB::table('post_categories')->insert($data);

        $data = [
            'post_id' => '5',
            'category_id' => '2',
        ];

        DB::table('post_categories')->insert($data);

        $data = [
            'post_id' => '5',
            'category_id' => '4',
        ];

        DB::table('post_categories')->insert($data);
    }
}
