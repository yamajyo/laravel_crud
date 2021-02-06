<?php

use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'title' => '初めてのPHP',
            'description' => 'PHPを初めて学ぶ方にお勧めのチュートリアルを紹介します',
        ];

        DB::table('post')->insert($data);

        $data = [
            'title' => 'PHP技術者認定試験について',
            'description' => 'PHPの技術者認定試験の概要を紹介します',
        ];

        DB::table('post')->insert($data);

        $data = [
            'title' => '初めてのLaravel',
            'description' => 'Laravelを初めて学ぶ方にお勧めのチュートリアルを紹介します',
        ];

        DB::table('post')->insert($data);

        $data = [
            'title' => '初めてのVue.js',
            'description' => 'Vue.jsを初めて学ぶ方にお勧めのチュートリアルを紹介します',
        ];

        DB::table('post')->insert($data);

        $data = [
            'title' => 'LaravelとVue.jsの組み合わせ',
            'description' => 'LaravelとVue.jsの組み合わせ方を紹介します',
        ];

        DB::table('post')->insert($data);
    }
}
