<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    function list(Request $request)
    {
        $userNme = $request->session()->get('name');
        $items = DB::select('select * from site');
        //これを使うとvar_dumpして処理がとまる
        return view('list', ['items' => $items, 'userName' => $userNme]);
    }

    function edit(Request $request)
    {
        if (isset($request->id)) {
            $dbRecord = DB::table('site')->where('id', $request->id)->first();
            $siteIdDbRecord = DB::table('site_site_category')->where('site_id', $request->id)->first();

            dd($siteIdDbRecord['site']);
            $p = [
                'name' => $dbRecord->name,
                'url' => $dbRecord->url,
                'description' => $dbRecord->description,
                'turn' => $dbRecord->turn,
            ];
        } else {
            $p = '';
        }

        $site_category_list = DB::select('select * from site_category');
        $userNme = $request->session()->get('name');
        return view('edit', ['userName' => $userNme, 'site_category_list' => $site_category_list, 'item' => $p]);
    }

    function editPos(Request $request)
    {
        $site_category_list = DB::select('select * from site_category');

        $userNme = $request->session()->get('name');
        $p = [
            'name' => $request->name,
            'url' => $request->url,
            'description' => $request->description,
            'turn' => $request->turn,
            'site_category_num' => $request->site_category_num
        ];

        return view('edit', ['item' => $p, 'site_category_list' => $site_category_list, 'userName' => $userNme]);
    }

    function conf(Request $request)
    {
        $site_category_list = DB::select('select * from site_category');
        foreach ($request->site_category as $value) {
            if (isset($value)) {
                $site_array[] = $site_category_list[$value - 1]->id;
            }
        }

        if (isset($site_array)) {
            foreach ($site_array as $value) {
                $site_array2[] = $site_category_list[$value - 1]->name;
            }
        }

        $userNme = $request->session()->get('name');

        $p = [
            'site' => isset($site_array2) ? $site_array2 : '',
            'name' => $request->name,
            'url' => $request->url,
            'description' => $request->description,
            'turn' => $request->turn,
            's' => $request->site_category
        ];
        return view('conf', ['item' => $p, 'userName' => $userNme]);
    }

    function done(Request $request)
    {
        $userNme = $request->session()->get('name');

        $pp = $request->all();

        DB::transaction(function() use ($pp) {

            $p = [
                'name' => $pp['name'],
                'url' => $pp['url'],
                'description' => $pp['description'],
                'turn' => $pp['turn']
            ];
            DB::insert('insert into site (name, url, description, turn) values (:name, :url, :description, :turn)', $p);

            $lastInsertId = DB::getPdo()->lastInsertId();

            foreach ($pp['site_category_num'] as $value) {
                if (isset($value)) {
                    $p2['site_id'] = $lastInsertId;
                    $p2['site_category_id'] = $value;
                    DB::insert('insert into site_site_category (site_id, site_category_id) values (:site_id, :site_category_id)', $p2);
                }
            }
        });

        return view('done', ['userName' => $userNme]);
    }
}
