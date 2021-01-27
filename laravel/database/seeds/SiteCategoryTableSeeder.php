<?php

use Illuminate\Database\Seeder;

class SiteCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $p = [
            'id' => 1,
            'name' => 'WEB、デザイン会社',
            'url' => 'web',
            'turn' => 1
        ];

        DB::table('site_category')->insert($p);

        $p = [
            'id' => 2,
            'name' => 'ゲーム',
            'url' => 'game',
            'turn' => 2
        ];

        DB::table('site_category')->insert($p);

        $p = [
            'id' => 3,
            'name' => '美容、健康',
            'url' => 'biyou',
            'turn' => 3
        ];

        DB::table('site_category')->insert($p);

        $p = [
            'id' => 4,
            'name' => '教育',
            'url' => 'kyouiku',
            'turn' => 4
        ];

        DB::table('site_category')->insert($p);

        $p = [
            'id' => 5,
            'name' => '通販',
            'url' => 'tuhan',
            'turn' => 5
        ];

        DB::table('site_category')->insert($p);

        $p = [
            'id' => 6,
            'name' => '口コミ',
            'url' => 'kutikomi',
            'turn' => 6
        ];

        DB::table('site_category')->insert($p);

        $p = [
            'id' => 7,
            'name' => 'その他',
            'url' => 'sonota',
            'turn' => 7
        ];

        DB::table('site_category')->insert($p);
    }
}
