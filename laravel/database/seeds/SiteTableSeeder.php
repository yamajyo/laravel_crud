<?php

use Illuminate\Database\Seeder;

class SiteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $p = [
            'name' => 'ゲム！ゲーム！',
            'url' => 'www/game.com',
            'img' => 'noImage.png',
            'description' => 'ゲームのサイト',
            'turn' => 1,
            'delete_flg' => false
        ];

        DB::table('sites')->insert($p);

        $p = [
            'name' => '美美容',
            'url' => 'www/biyou.com',
            'img' => 'noImage.png',
            'description' => '美容関係のサイト',
            'turn' => 2,
            'delete_flg' => false
        ];

        DB::table('sites')->insert($p);

        $p = [
            'name' => 'ゲム！ゲーム！2',
            'url' => 'www/game2.com',
            'img' => 'noImage.png',
            'description' => 'スマホゲームのサイト',
            'turn' => 3,
            'delete_flg' => false
        ];

        DB::table('sites')->insert($p);
    }
}
